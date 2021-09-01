<template>
    <section id="ms-jumbotron" class="d-flex flex-column justify-content-center align-items-center py-5">
        <div class="my-5 d-flex flex-column justify-content-center align-items-center">
             <form class="ms-form my-lg-0 mt-5">
                <input class="ms-input px-4 my-2 " placeholder="Start your search">
                <button class="ms-btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <h3 class="text-center my-5">Not sure where to go? Perfect.</h3>
            <button type="submit" class="ms-style px-5 py-3">
                <router-link :to="{name: 'locations'}">I'm flexible</router-link>
            </button>
        </div>
       
    </section> 
</template>

<script>
export default {
    name: "Jumbotron"

}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';

</style>