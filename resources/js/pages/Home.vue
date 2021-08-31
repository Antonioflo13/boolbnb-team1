<template>
    <section>
        <Jumbotron />
        <!-- Test prima di API -->
        <section class="container">
            <h3 class="mt-5"><strong>Live anywhere</strong></h3>
            <!-- <div class="row">
                <div class="col">
                <div class="d-flex flex-column align-items-center">
                    <img src="/images/minimal-living-1.jpg" alt="">
                    <h6><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-center">
                    <img src="/images/minimal-living-2.jpg" alt="">
                    <h6><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-center">
                    <img src="/images/minimal-living-4.jpg" alt="">
                    <h6><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-center">
                    <img src="/images/minimal-room-1.jpg" alt="">
                    <h6><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
            </div>

            </div>  -->
            <div class="d-flex flex-start justify-content-between flex-wrap">
                <div class="d-flex flex-column align-items-center mt-4 ms-card">
                    <img src="/images/minimal-living-1.jpg" alt="">
                    <h6 class="mt-3"><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
                <div class="d-flex flex-column align-items-center mt-4 ms-card">
                    <img src="/images/minimal-living-2.jpg" alt="">
                    <h6 class="mt-3"><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
                <div class="d-flex flex-column align-items-center mt-4 ms-card">
                    <img src="/images/minimal-living-4.jpg" alt="">
                    <h6 class="mt-3"><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
                <div class="d-flex flex-column align-items-center mt-4 ms-card">
                    <img src="/images/minimal-room-1.jpg" alt="">
                    <h6 class="mt-3"><a href="">Lorem, ipsum dolor.</a></h6>
                </div>
            </div>   
        </section>
    </section> 
</template>

<script>
import Jumbotron from '../components/Jumbotron';
export default {
    name: 'Home',
    components: {
        Jumbotron
    }

}
</script>

<style scoped lang="scss">

    img {
        width: 300px;
        border-radius: 10px;
    }

    @media all and(max-width: 576px){
      img {
        width: 100%; 
      } 
    }


</style>