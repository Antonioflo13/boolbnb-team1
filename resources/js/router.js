import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

// import components
import Home from './pages/Home';
import Locations from './pages/Locations';

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
        }
    ]
})

export default router;