import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
Vue.use(ElementUI);
import App from './layouts/App';
import store from './store';
import './util/interceptors';
import router from './router';
import localforage from 'localforage';

localforage.setDriver(localforage.LOCALSTORAGE);

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');