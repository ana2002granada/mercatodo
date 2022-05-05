import Vue from "vue";

window.Vue = Vue;

import Alpine from "alpinejs";
import Alert from "./components/Alert";
import Dropdown from "./components/Dropdown";
import Modal from "./components/Modal";
import Carousel from "./components/Carousel";
import vSelect from "./components/VSelect";
import SearchBar from "./components/SearchBar";
import Cart from "./components/Cart";
import Charts from "./components/Charts";
import LineChart from "./components/LineChart";

window.Alpine = Alpine;

Alpine.start();

require("./bootstrap");

window.events = new Vue();

Vue.component("alert", Alert);
Vue.component("dropdown", Dropdown);
Vue.component("modal", Modal);
Vue.component("carousel", Carousel);
Vue.component("v-select", vSelect);
Vue.component("v-search-bar", SearchBar);
Vue.component("v-cart", Cart);
Vue.component("v-charts", Charts);
Vue.component('v-line-chart', LineChart
);
new Vue({
    el: "#app",
    name: "App",
});
