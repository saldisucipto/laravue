require('./bootstrap');

window.Vue = require('vue');

// Import Vue Router 
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import Components 
import Dashboard from './components/Dashboard.vue'
import Profile from './components/Profile.vue'


let routes = [{
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
}, {
    path: '/profile',
    name: 'Profile',
    component: Profile
}]

const router = new VueRouter({
    mode: 'history',
    routes
})


const app = new Vue({
    el: '#app',
    router
});
