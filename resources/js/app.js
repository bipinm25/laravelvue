/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import routes from './router'

import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import store from './store'
import mixins from "./mixins";

Vue.use(ViewUI);
Vue.mixin(mixins);

const options = {
    // You can set your default options here
};
Vue.use(Toast, options);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('newheader', require('./components/header.vue').default);
Vue.component('pagination', require('./components/pagination.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router:routes,
    store
});
