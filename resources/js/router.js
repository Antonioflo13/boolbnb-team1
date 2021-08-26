import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

// import components
import Home from './components/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        }
    ]
})

export default router;