<template>
    <section>
        <Jumbotron 
            @searchedApps="searchedApps"
        />
        <!-- Test prima di API -->
        <section class="container">
            <h3 class="mt-5"><strong>In Evidence</strong></h3>
            <div class="d-flex flex-start flex-wrap mb-4">
                <!-- Da aggiornare in modo dinamico -->
                <div class="d-flex flex-column align-items-center mt-4 ms-card" v-for='(appProm, index) in promotedApps' :key='index'>
                    <div class="ms-img-container">
                        <img :src="appProm.image" :alt="appProm.title" v-if="appProm.image.substr(0,5) == 'https'">
                        <img :src="'http://127.0.0.1:8000/storage/'  + appProm.image" :alt="appProm.title" v-else>
                    </div>
                    <h6 class="mt-3 text-center"><a href="">{{appProm.title}}</a></h6>
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
    },
    data(){
        return{
            promotedApps: [],
            res: []
        }
    },
    methods: {
        searchedApps: function(res) {
            this.res = res;
        },
        getPromotedApps: function(){
            axios
            .get('http://127.0.0.1:8000/api/appartments')
            .then(res=> {
                //this.promotedApps = res.data
                    this.promotedApps = res.data.filter(
                        (element)=> {
                            return element.promotions.length !=0;   
                        }
                        
                    )
                })
                .catch(err=> {
                    console.log(err);
                })

        }

    },
    created: function() {
         this.getPromotedApps();
    }


}
</script>

<style scoped lang="scss">

    .ms-img-container {
        width: 300px;
        img{
            width: 100%;
            border-radius: 10px;
        }
    }

    @media all and(max-width: 576px){
      img {
        width: 100%; 
      } 
    }


</style>