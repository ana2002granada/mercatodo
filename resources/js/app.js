import Vue from "vue";

window.Vue = Vue;

import Alpine from 'alpinejs';
import Alert from "./components/Alert";
import Dropdown from "./components/Dropdown";
import DeleteModal from "./components/DeleteModal";

window.Alpine = Alpine;

Alpine.start();

require('./bootstrap');

window.events = new Vue();

Vue.component('alert', Alert);
Vue.component('dropdown', Dropdown);
Vue.component("modal", DeleteModal);

new Vue({
    el: '#app',
    name: 'App',
});
