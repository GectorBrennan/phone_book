require('./bootstrap');

import Vue from 'vue'

Vue.component('info-window', require('./components/InfoWindow.vue'));

const app = new Vue({
    el: '#app'
});

