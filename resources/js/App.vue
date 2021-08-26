<template>
    <div>
        <router-view></router-view>
        <h1>prova</h1>
    </div>
</template>

<script>
import Home from './components/Home.vue';
export default {
    name: 'App',
    components:  {
        Home,
    }
}
</script>

<style>

</style>