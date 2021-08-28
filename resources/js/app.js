

require('./bootstrap');

//window.Vue = require('vue');


window.Vue = require("vue");
import store from "./store/index";
import router from "./router/index";

Vue.component('pagination', require('laravel-vue-pagination'));
window.store= store;
const app = new Vue({
    el: '#app',
    store,
    router
});
