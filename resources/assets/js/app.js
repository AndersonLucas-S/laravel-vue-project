
require('./bootstrap');
window.Vue = require('vue');
import Snotify from 'vue-snotify';

import Vue from 'vue';
import router from './routes/routers';
import store from './vuex/store';

Vue.use(Snotify, {toast: {showProgressBar: false}});

Vue.component('admin-component', require('./components/admin/AdminComponent'))
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent'))

const app = new Vue({
    router,
    store,
    el: '#app'
});

store.dispatch('loadCategories')
