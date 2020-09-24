require("./bootstrap");

window.Vue = require("vue");

// Import Vue Router
import VueRouter from "vue-router";
// import Momen
import moment from "moment";
// import vue-router
import VueProgressBar from "vue-progressbar";
// import sweat alert 
import swal from 'sweetalert2';
// import Components
import Dashboard from "./components/Dashboard.vue";
import Profile from "./components/Profile.vue";
import User from "./components/User.vue";
import Developer from "./components/Developer.vue";


// pasport components 
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

window.swal = swal

// example toast with sweat alert
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})

window.toast = toast

Vue.use(VueRouter);
// vform
// deklare vue moment
Vue.filter("myData", function (created) {
    return moment().format("DD MMMM YYYY");
});

// use progress bar
Vue.use(vueProgressbar, {
    color: "rgb(143,255,199)",
    failedcolor: "red",
    height: "2px"
});
import {
    Form,
    HasError,
    AlertError
} from "vform";
import vueProgressbar from "vue-progressbar";
window.form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

let routes = [{
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile
    },
    {
        path: "/user",
        name: "User",
        component: User
    },
    {
        path: "/developer",
        name: "Developer",
        component: Developer
    }
];


const router = new VueRouter({
    mode: "history",
    routes
});

const app = new Vue({
    el: "#app",
    router
});
