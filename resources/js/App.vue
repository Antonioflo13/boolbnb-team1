<template>
    <div>
        <Nav @searchedApps="searchedApps" />
        <main>  
            <!-- component matched by the route will render here -->
            <router-view :resultApps="resultApps" ></router-view>
        </main> 
        <Footer/>   
    </div>
</template>

<script>
import Nav from './components/Nav.vue';
import Footer from './components/Footer';

export default {
    name: 'App',
    components:  {
        Nav,
        Footer
    },
    data () {
        return {
            resultApps : []
        }
    },
    methods: {
        searchedApps: function(res){
            this.resultApps=res;
        },
    }
}
</script>

<style>

</style>