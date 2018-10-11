<template>
    <div id="iw-container" :style="{ 'background-image' : 'url(' + marker.img + ')' }">

        <div class="iw-content" >
            <div class="iw-title">
                {{ marker.title }}
            </div>

            <div class="iw-button">
                <button @click="$emit('makeOrder')">Make order</button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: [
            'marker'
        ],
        methods: {
            test: function () {
                this.$emit('makeOrder')
            }
        }
    }
</script>
<style>

    .gm-style-iw {
        width: 350px !important;
        top: 15px !important;
        left: 0px !important;
        background-color: #fff;
        box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
        border: 1px solid rgba(72, 181, 233, 0.6);
        border-radius: 2px 2px 10px 10px;
    }

    #iw-container {
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        min-height: 200px;
        display: flex;
    }

    .iw-content  {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        display: flex;
        background-color: #4285F4;
        min-height: 30%;
    }

    .iw-title {
        width: 65%;
        float: left;
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 22px;
        font-weight: 600;
        padding: 10px;
        color: #fff;
    }

    .iw-button {
        float: right;
        overflow: hidden;
        margin: 0 auto;
        padding: 0px 10px
    }

    .iw-button button {
        border: none;
        margin-top: 10px;
        padding: 7px;
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.6);
        border-radius: 15px;
        background-color: #fff;
        font-size: 16px;
        font-weight: 600;
        color: #4285F4;
        outline: none;
        cursor: pointer;
        transition: .1s;
    }
    .iw-button button:hover {
        box-shadow: 0 3px 14px 0 rgba(0, 0, 0, .6);
    }

    .iw-button button:active {
        box-shadow: 0 3px #666;
        transform: translateY(2px);
    }
</style>