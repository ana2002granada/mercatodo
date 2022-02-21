import Vue from "vue";

window.Vue = Vue;

import Alpine from 'alpinejs';
import Alert from "./components/Alert";
import Dropdown from "./components/Dropdown";
import DeleteModal from "./components/DeleteModal";
import Carousel from "./components/Carousel";
import vSelect from "./components/VSelect";
import SearchBar from "./components/SearchBar";

window.Alpine = Alpine;

Alpine.start();

require('./bootstrap');

window.events = new Vue();

Vue.component('alert', Alert);
Vue.component('dropdown', Dropdown);
Vue.component('modal', DeleteModal);
Vue.component('carousel', Carousel);
Vue.component('v-select', vSelect);
Vue.component('v-search-bar', SearchBar);

new Vue({
    el: '#app',
    name: 'App',
});
