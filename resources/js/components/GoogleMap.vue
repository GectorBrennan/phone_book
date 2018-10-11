<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <GmapMap
                        ref="map"
                        :center="center"
                        :zoom="zoom"
                        map-type-id="roadmap"
                        style=" height: 600px"
                        :options="{streetViewControl: false, disableDefaultUI: true, styles: styles }"

                >
                    <GmapCircle :center="circleOptions.center"
                                :options="circleOptions"
                    ></GmapCircle>


                    <GmapInfoWindow :options="infoOptions"
                                    :position="currentRestaurant.position"
                                    :opened="infoWinOpen"
                                    @closeclick="infoWinOpen=false"
                                    ref="infoWindow"
                                    @domready="domready"

                    >
                        <info-window
                                :marker="currentRestaurant"
                                v-on:makeOrder="makeOrder"
                        >
                        </info-window>
                    </GmapInfoWindow>


                    <GmapMarker
                            :key="index"
                            v-for="(restaurant, index) in restaurants"
                            :position="restaurant.position"
                            :visible="restaurant.visible"
                            @click="toCenter(restaurant, index)"
                    />

                    <GmapMarker
                            v-for="courier in couriers"
                            :position="courier.position"
                            :icon="{url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'}"
                            :visible="courier.visible || showCouriers"
                            @click="hideCourier(courier)"
                    />


                </GmapMap>
            </div>
            <div class="col-md-3 menu">
                <div class="row show-couriers">
                    <input type="checkbox" id="show-couriers" v-model="showCouriers"/>
                    <label for="show-couriers">Show Couriers</label>

                </div>

                <div class="row">
                    <div class="order" v-show="order.show">
                        <div class="restaurant" :style="{ 'background-image' : 'url(' + order.restaurant.img + ')' }">
                            <span>{{ order.restaurant.title  }}</span>
                        </div>
                        <div class="content">

                        </div>
                    </div>
                </div>

                <div class="row refresh">
                    <button v-show="order.show" @click="refreshMap">Refresh Map</button>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import * as restaurants from '../restaurants.json';
    import * as couriers from '../couriers.json';
    import * as styles from '../map_styles.json';
    import {gmapApi} from 'vue2-google-maps'

    export default {

        name: "GoogleMap",
        data() {
            return {
                styles: styles,
                restaurants: restaurants.restaurants,
                couriers: couriers.couriers,
                center: {lat: 50.451826, lng: 30.515741},
                zoom: 14,
                currentRestaurant: {},
                currentMidx: null,
                infoWinOpen: false,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                },
                circleOptions: {
                    strokeColor: '#61B3F3',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#4D9BD7',
                    fillOpacity: 0.35,
                    radius: Math.sqrt(15) * 100,
                    visible: false,
                    center: {lat: 0, lng: 0}
                },
                showCouriers: false,
                order: {
                    show: false,
                    restaurant: {},
                    couriers: {}
                },
                directionsDisplay: null
            };
        },
        computed: {
            google: gmapApi,
        },
        watch: {
            'google': function () {
                this.directionsDisplay = new this.google.maps.DirectionsRenderer;
                this.directionsDisplay.setMap(this.$refs.map.$mapObject);
                
                console.log(this.$refs.map.mapObject)
            }
        },
        mounted: function () {
        },
        methods: {

            toCenter: function (restaurant, index) {

                this.currentRestaurant = restaurant;

                if (this.currentMidx == index) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = index;

                }
            },
            makeOrder: function () {

                this.hideRestourantsExcepCurrent();
                this.center = this.currentRestaurant.position;
                this.zoom = 15;
                this.circleOptions.center = this.currentRestaurant.position;

                this.circleOptions.visible = true;
                this.infoWinOpen = false;

                this.order.show = true;
                this.order.restaurant = {
                    title: this.currentRestaurant.title,
                    img: this.currentRestaurant.img,
                    position: this.currentRestaurant.position
                };

                this.showClosestCourier();

                this.showRandomCourier();

                this.renderDirections();
            },
            hideRestourantsExcepCurrent: function () {
                this.restaurants.forEach((item) => {
                    if (item.id != this.currentRestaurant.id) {
                        item.visible = false
                    }
                })
            },
            showClosestCourier: function () {
                var orderLat = this.order.restaurant.position.lat;
                var orderLng = this.order.restaurant.position.lng;

                var closets_distance = 100000000000000;
                var closets_courier = null;

                this.couriers.forEach((item) => {

                    var distance = this.google.maps.geometry.spherical.computeDistanceBetween(
                        new this.google.maps.LatLng(orderLat, orderLng),
                        new this.google.maps.LatLng(item.position.lat, item.position.lng)
                    );

                    if (distance < closets_distance) {
                        closets_distance = distance
                        closets_courier = item;
                    }
                });

                this.order.couriers.closets = closets_courier;

                this.order.couriers.closets.visible = true
                
                console.log()
            },

            showRandomCourier: function () {
                this.order.couriers.random = this.couriers[Math.floor(Math.random() * this.couriers.length)];

                this.order.couriers.random.visible = true
            },

            renderDirections: function () {

                var directionsService = new this.google.maps.DirectionsService;

                console.log(this.directionsDisplay)
                directionsService.route({
                    origin: this.order.restaurant.position,
                    destination: this.order.couriers.closets.position,
                    travelMode: this.google.maps.TravelMode['DRIVING']
                }, function (response, status) {
                    console.log(response)
                    if (status == 'OK') {
                        this.directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            },

            domready: function () {
                var iwOuter = $('.gm-style-iw');

                var iwBackground = iwOuter.prev();


                iwBackground.children(':nth-child(2)').css({'display': 'none'});
                iwBackground.children(':nth-child(4)').css({'display': 'none'});

                iwOuter.children().css({'display': 'block'})
                iwOuter.next().css({
                    'right': '52px',
                    'top': '16px',
                    'border-radius': '10px'
                }).children().css({'background-color': '#fff', 'border-radius': '3px'})
            },

            refreshMap: function () {


                this.order = {
                    show: false,
                    restaurant: {},
                    couriers: {}
                };
                this.center = {lat: 50.451826, lng: 30.515741}
                this.circleOptions.visible = false;


                this.zoom = 14
                this.restaurants.forEach((item) => {
                    item.visible = true
                })

                this.couriers.forEach((item) => {
                    item.visible = false
                })

            }
        }
    };
</script>

<style>
    .menu {
        height: auto;
        border: 1px solid rgba(10, 16, 49, .2);
        box-shadow: 0 2px 10px rgba(10, 16, 49, .5);
        border-radius: 5px;
        position: relative;
    }

    .show-couriers {
        padding: 30px;
    }

    #show-couriers {
        position: absolute;
        z-index: -1;
        opacity: 0;
        margin: 10px 0 0 20px;
    }

    #show-couriers + label {
        position: relative;
        padding: 0 0 0 60px;
        cursor: pointer;
    }

    #show-couriers + label:before {
        content: '';
        position: absolute;
        top: -4px;
        left: 0;
        width: 50px;
        height: 26px;
        border-radius: 13px;
        background: #CDD1DA;
        box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2);
        transition: .2s;
    }

    #show-couriers + label:after {
        content: '';
        position: absolute;
        top: -2px;
        left: 2px;
        width: 22px;
        height: 22px;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
        transition: .2s;
    }

    #show-couriers:checked + label:before {
        background: #61B3F3;
    }

    #show-couriers:checked + label:after {
        left: 26px;
    }

    #show-couriers:focus + label:before {
        box-shadow: 0 2px 10px rgba(10, 16, 49, .5)
    }

    .order {
        width: 100%;
    }

    .order .restaurant {
        background-position: center;
        width: 100%;
        background-size: cover;
        min-height: 180px;
        position: relative;
    }

    .order .restaurant span {
        position: absolute;
        bottom: 0;
        color: #fff;
        left: 0;
        right: 0;
        background: #4285F4;
        height: 30%;
        display: block;
        padding: 10px;
        font-size: 22px;
        font-weight: 600;
    }

    .refresh {
        position: absolute;
        bottom: 25px;
        right: 0;
        left: 0;
    }

    .refresh button {
        width: 150px;
        margin: 0 auto;
        height: 50px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(to bottom, rgba(102, 152, 203, 1) 0%, rgba(92, 138, 184, 1) 100%);
        color: #fff;
        text-transform: uppercase;
        font-family: Roboto, Arial, sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        outline: none
    }

    .refresh button:active {
        background: linear-gradient(to bottom, rgba(102, 152, 203, .5) 0%, rgba(92, 138, 184, .5) 100%);
    }
</style>