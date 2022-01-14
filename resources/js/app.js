import Vue from "vue";

window.Vue = Vue;

import Alpine from 'alpinejs';
import Alert from "./components/Alert";
import Dropdown from "./components/Dropdown";
import DeleteModal from "./components/DeleteModal";
import InputImage from "./components/InputImage";

window.Alpine = Alpine;

Alpine.start();

require('./bootstrap');

window.events = new Vue();

Vue.component('alert', Alert);
Vue.component('dropdown', Dropdown);
Vue.component("modal", DeleteModal);
Vue.component("input-image", InputImage);

new Vue({
    el: '#app',
    name: 'App',
});
