<template>
    <div>
        <Nav/>
        <main>  
            <!-- component matched by the route will render here -->
            <router-view></router-view>
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
    }
}
</script>

<style>
    main{
        min-height: calc(100vh - 200px);

}

</style>