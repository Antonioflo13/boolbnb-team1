import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

// import components
import Home from './pages/Home';
import Locations from './pages/Locations';
import SingleLocation from './pages/SingleLocation';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/locations/:slug',
            name: 'locations',
            component: Locations
        },
        {
            path:'/locations/:slug',
            name:'single-location',
            component: SingleLocation
        },
    ]
})

export default router;