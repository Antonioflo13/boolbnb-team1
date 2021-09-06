<template>
    <section class="mb-5">
        <Jumbotron 
            @searchedApps="searchedApps"
        />
        <section class="container">
            <h3 class="mt-5"><strong>In Evidence</strong></h3>
            <div class="row mb-4 ">
                <div class="mt-4 col col-sm-6 col-lg-4" v-for='(appProm, index) in promotedApps' :key='index'>
                    <div class="ms-img-container">
                        <img :src="appProm.image" :alt="appProm.title" v-if="appProm.image.substr(0,5) == 'https'">
                        <img :src="'http://127.0.0.1:8000/storage/'  + appProm.image" :alt="appProm.title" v-else>
                    </div>
                    <router-link :to="{name: 'single-location', params: { slug: appProm.slug}}">
                        {{appProm.title}}
                    </router-link>
                </div>
            </div> 
            <!-- //Fatto MD -->
            <h3 class="mt-5"><strong>Live Anywhere</strong></h3>
            <div class=" mb-4  row " v-if="selectedAppartmentsHome.length > 0">
                <div class="mt-4 col col-sm-6 col-lg-4" v-for='(app, index) in selectedAppartmentsHome' :key='index'>
                    <div class="ms-img-container">
                        <img :src="app.image" :alt="app.title" v-if="app.image.substr(0,5) == 'https'">
                        <img :src="'http://127.0.0.1:8000/storage/'  + app.image" :alt="app.title" v-else>
                    </div>
                    <h6 class="mt-3 text-center"><a href=""></a></h6>
                    <router-link :to="{name: 'single-location', params: { slug: app.slug}}">
                                {{app.title}}
                    </router-link>
                </div>
            </div> 
            <div class="mt-4" v-else>
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fas fa-exclamation-circle mr-2 fa-2x"></i>
                        <p class="mb-0">No appartments exists with the selected criteria, please select different criteries</p>
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
            appartments:[],
            res: []
        }
    },
    // Fatto MD
    computed: {
        selectedAppartmentsHome: function() {
            if(this.res.length == 0) {
                return this.appartments;
            } else {
                let newAppartmentsHome = [];
                this.appartments.forEach(element => {
                    this.res.forEach(item =>{
                        if(item.id == element.id ){
                            newAppartmentsHome.push(element);
                        } else {
                            return newAppartmentsHome = [];
                        }
                    })
                }) 
                return newAppartmentsHome;    
            }   
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
                    this.appartments=res.data;
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

    @media all and (max-width: 576px){
      img {
        width: 100%; 
      } 
    }
</style>