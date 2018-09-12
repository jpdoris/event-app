
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-material-design-icons/styles.css';
import '../sass/app.scss';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import UsersIndex from './views/UsersIndex'
import EditUser from './views/EditUser'

import Eye from "vue-material-design-icons/Eye.vue";
import Account from "vue-material-design-icons/Account.vue"

components: {[
    Account,
    Eye,
]}

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
        },
        {
            path: '/user/:username',
            name: 'user.view',
            component: EditUser
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
