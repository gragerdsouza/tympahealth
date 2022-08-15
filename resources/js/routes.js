import AllDevice from './components/AllDevice.vue';

import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

const routes = [
    {
        name: 'home',
        path: '/',
        component: AllDevice
    },
    {   path: "*", 
        component: {
            template: '<h1>Page Not Found</h1>'
        } ,
        name: "pagenotfound",
    }
];

const router = new VueRouter({
    routes: routes,
    mode: 'history'
});
export default router