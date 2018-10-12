<template>
    <div class="container">

        <div class="title">PhoneBook</div>
        <div class="search">
            <input type="text" class="search-filed" v-model="search_name" v-on:keyup.enter="search">
            <button type="submit" class="search-icon" @click="search"></button>
            <button v-if="search_name.length" class="search-clear" @click="search_name = ''; getList()"></button>
        </div>

        <add v-on:createContact="createContact"></add>

        <div class="info">
            <h1>Contacts</h1>
            <span>Count: {{ contacts.length }}</span>
        </div>
        <div class="contacts">
            <template v-for="contact in contacts">
                <contact :contact="contact"
                        v-on:deleteContact="getList"></contact>
            </template>

        </div>

        <div class="pagination">
            <div class="first" v-if="page > 1" @click="paginate(1)"> <<</div>
            <div class="prev" v-if="page > 1" @click="paginate(page - 1)"> <</div>
            <ul v-for="">
                <li v-for="n in Math.ceil(total / per_page)" v-bind:class="{active : (n == page) }" @click="paginate(n)">{{n}}</li>
            </ul>
            <div class="next"  v-if="page < Math.ceil(total / per_page)" @click="paginate(page + 1)"> ></div>
            <div class="last" v-if="page < Math.ceil(total / per_page)" @click="paginate(Math.ceil(total / per_page))"> >></div>

        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                page: 1,
                per_page: 12,
                contacts: [],
                total: 0,
                search_name: '',
            }
        },

        mounted: function () {
            this.getList();
        },

        methods: {
            getList: function () {

                let params  = {
                    page: this.page,
                    per_page: this.per_page
                };

                api.get('api/contact.getList', { params: params}).then(response => {

                    this.contacts = response.data.response.data
                    this.total = response.data.response.total
                })
            },
            paginate: function(n) {
               this.page = n;

                if (this.search_name.length) {

                    this.search();
                } else {

                    this.getList();
                }
            },
            
            search: function () {
                let params = {
                    name: this.search_name,
                    page: this.page,
                    per_page: this.per_page
                }
                api.get('api/contact.getByName', {params: params}).then(response => {

                    this.contacts = response.data.response.data
                    this.total = response.data.response.total
                })
            },
            createContact: function (contact) {
                this.contacts.unshift(contact)
            }
        }
    }
</script>