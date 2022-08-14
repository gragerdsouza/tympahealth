import AllDevice from './components/AllDevice.vue';
import CreateDevice from './components/CreateDevice.vue';
import EditDevice from './components/EditDevice.vue';

import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

const routes = [
    {
        name: 'home',
        path: '/',
        component: AllDevice
    },
    {
        name: 'create',
        path: '/create',
        component: CreateDevice
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditDevice
    
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