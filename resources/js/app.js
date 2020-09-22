require('./bootstrap');

window.Vue = require('vue');

// Import Vue Router 
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import Components 
import Dashboard from './components/Dashboard.vue'
import Profile from './components/Profile.vue'
import User from './components/User.vue'


let routes = [{
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
}, {
    path: '/profile',
    name: 'Profile',
    component: Profile
}, {
    path: '/user',
    name: 'User',
    component: User
}]

const router = new VueRouter({
    mode: 'history',
    routes
})


const app = new Vue({
    el: '#app',
    router
});
