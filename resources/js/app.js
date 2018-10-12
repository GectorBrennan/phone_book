require('./bootstrap');

import Vue from 'vue'

Vue.component('app', require('./components/App.vue'));
Vue.component('contact', require('./components/Contact.vue'));
Vue.component('add', require('./components/Add.vue'));

const app = new Vue({
    el: '#app'
});

