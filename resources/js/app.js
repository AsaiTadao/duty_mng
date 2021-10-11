require("./bootstrap");

window.Vue = require("vue").default;

import { Form, HasError, AlertError } from "vform";
window.Form = Form;

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import moment from "moment";
moment.locale("ja", {
    weekdays: [
        "日曜日",
        "月曜日",
        "火曜日",
        "水曜日",
        "木曜日",
        "金曜日",
        "土曜日"
    ],
    weekdaysShort: ["日", "月", "火", "水", "木", "金", "土"]
});

import Swal from "sweetalert2";

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});
window.Swal = Swal;
window.Toast = Toast;

import VueProgressBar from "vue-progressbar";
import App from "./App.vue";

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "3px"
});

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

/**
 * Routes imports and assigning
 */
import VueRouter from "vue-router";
import routes from "./routes";
import Vue from "vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes
});
// Routes End

// Components

// const files = require.context('./components/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component("home", require("./components/Home.vue"));

Vue.component("not-found", require("./components/NotFound.vue").default);

// Filter Section

Vue.filter("formatDateTime", function(created) {
    return moment(created).format("YYYY年MM月DD日 h:mm");
});
Vue.filter("formatDateTimeW", function(created) {
    return moment(created).format("YYYY年MM月DD日(ddd) h:mm");
});
Vue.filter("formatDate", function(created) {
    return moment(created).format("YYYY年MM月DD日");
});
Vue.filter("formatDateW", function(created) {
    return moment(created).format("YYYY年MM月DD日(ddd)");
});
Vue.filter("formatDay", function(created) {
    return moment(created).format("D日");
});
Vue.filter("formatWeek", function(created) {
    return moment(created).format("ddd");
});

Vue.filter("yesno", value =>
    value
        ? '<i class="fas fa-check green"></i>'
        : '<i class="fas fa-times red"></i>'
);

// end Filter

// Global variables
Vue.prototype.$request_type = [
    { id: 1, name: "遅刻" },
    { id: 2, name: "早退" },
    { id: 3, name: "その他" }
];

Vue.prototype.$shift_type = [
    { id: 1, name: "正社員" },
    { id: 2, name: "時短" },
    { id: 3, name: "パート" },
];

Vue.prototype.$rest_type = [
    { id: 1, name: "年次有休" },
    { id: 2, name: "特別休暇" },
];

const app = new Vue({
    el: "#app",
    router,
    render: h => h(App)
});
