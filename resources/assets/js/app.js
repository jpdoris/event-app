
window.Vue = require('vue');


import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-material-design-icons/styles.css';
import '../sass/app.scss';

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import ajax from './directives/ajax'
// import Post from './directives/Post'
import UsersIndex from './views/UsersIndex'
import EditUser from './views/EditUser'

import Eye from "vue-material-design-icons/Eye.vue";
import Account from "vue-material-design-icons/Account.vue"

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.directive('ajax', ajax);
// Vue.directive('Post', Post);


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
