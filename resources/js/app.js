
window.Vue = require('vue');


import Vue from 'vue'
import VueRouter from 'vue-router'
import vSelect from 'vue-select'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-material-design-icons/styles.css';
import '../sass/app.scss';
import 'vue-select/dist/vue-select.css';

import App from './views/App'
import Home from './views/Home'
import ajax from './directives/ajax'
// import Post from './directives/Post'
import UsersIndex from './views/UsersIndex'
import ViewUser from './views/ViewUser'
import EditUser from './views/EditUser'
import EventsIndex from './views/EventsIndex'
import ViewEvent from './views/ViewEvent'
import EditEvent from './views/EditEvent'
import VCalendar from 'v-calendar';

Vue.use(VCalendar, {
    firstDayOfWeek: 1,  // Sunday
});
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.directive('ajax', ajax);
// Vue.directive('Post', Post);
Vue.component('v-select', vSelect);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
        },
        {
            path: '/user/:username',
            name: 'user.view',
            component: ViewUser
        },
        {
            path: '/user/:username',
            name: 'user.edit',
            component: EditUser
        },
        {
            path: '/events',
            name: 'events.index',
            component: EventsIndex,
        },
        {
            path: '/event/:id',
            name: 'event.view',
            component: ViewEvent
        },
        {
            path: '/event/:id',
            name: 'event.edit',
            component: EditEvent
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
