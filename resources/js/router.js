import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import components
import Home from './pages/Home';
import Locations from './pages/Locations';
import SingleLocation from './pages/SingleLocation';
import Error404 from './components/Error404';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/locations/:slug?',
            name: 'locations',
            component: Locations
        },
        {
            path:'/singlelocation/:slug',
            name:'single-location',
            component: SingleLocation
        },
        {
            path:'*',
            name:'error-404',
            component: Error404
        }
    ],
    scrollBehavior(to, from, savedPosition){
        if(savedPosition){
          return savedPosition
        }
        return{ x: 0, y: 0}
    }
})

export default router;