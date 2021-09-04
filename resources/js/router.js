import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

// import components
import Home from './pages/Home';
import Locations from './pages/Locations';
import SingleLocation from './pages/SingleLocation';
import Navbar from './pages/Navbar';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/locations',
            name: 'locations',
            component: Locations,
            props: true
        },
        {
            path:'/locations/:slug',
            name:'single-location',
            component: SingleLocation
        },
        {
            path:'/navbar',
            name:'navbar',
            component: Navbar
        },
    ]
})

export default router;