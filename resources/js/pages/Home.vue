<template>
    <section class="mb-5" v-if="(!loading)">
        <Jumbotron 
            @searchedApps="searchedApps"
        />
        <section class="container">
            <h3 class="mt-5"><strong>In Evidence</strong></h3>
            <div class="row mb-4 ">
                <div class="mt-4 col-12 col-sm-6 col-lg-4" v-for='(appProm, index) in promotedApps' :key='index'>
                    <div class="ms-img-container">
                        <img :src="appProm.image" :alt="appProm.title" v-if="appProm.image.substr(0,5) == 'https'">
                        <img :src="'http://127.0.0.1:8000/storage/'  + appProm.image" :alt="appProm.title" v-else>    
                    </div>
                    
                    <div class="d-flex flex-wrap align-items-center mt-3 mb-1">
                        <i class="fas fa-map-marker-alt"></i>
                        <p class="ml-2 mb-0 ms-adress-color">{{appProm.address}}</p>
                    </div>
                    <router-link :to="{name: 'single-location', params: { slug: appProm.slug}}" class="ms-router-color">
                        {{appProm.title}}
                    </router-link>
                    <!-- <i class="fas fa-star position-absolute"></i> -->
                </div>   
            </div> 
            <!-- //Fatto MD -->
            <h3 class="mt-5"><strong>Live Anywhere</strong></h3>
            <div class=" mb-4  row " v-if="selectedAppartmentsHome.length > 0">
                <div class="mt-4 col-12 col-sm-6 col-lg-4" v-for='(app, index) in selectedAppartmentsHome' :key='index'>
                    <div class="ms-img-container">
                        <img :src="app.image" :alt="app.title" v-if="app.image.substr(0,5) == 'https'">
                        <img :src="'http://127.0.0.1:8000/storage/'  + app.image" :alt="app.title" v-else>
                    </div>
                    <div class="d-flex flex-wrap align-items-center mt-3 mb-1">
                        <i class="fas fa-map-marker-alt"></i>
                        <p class="ml-2 mb-0 ms-adress-color">{{app.address}}</p>
                    </div>
                    <div class="">
                        <router-link :to="{name: 'single-location', params: { slug: app.slug}}" class="ms-router-color">
                            {{app.title}}
                        </router-link>
                    </div>   
                </div>
            </div> 
            <div class="mt-4" v-else>
                <div class="d-flex flex-wrap align-items-center mb-4">
                    <i class="fas fa-exclamation-circle mr-2 fa-2x"></i>
                    <p class="mb-0">No appartments exists with the selected criteria, please select different criteries</p>
                </div> 
            </div>      
        </section>
    </section> 
    <Loader v-else/>
</template>

<script>
import Jumbotron from '../components/Jumbotron';
import Loader from '../components/Loader'
export default {
    name: 'Home',
    components: {
        Jumbotron,
        Loader
    },
    data(){
        return{
            promotedApps: [],
            appartments:[],
            res: [],
            loading: true
        }
    },
    // Fatto MD
    computed: {
        selectedAppartmentsHome: function() {
            if(this.res.length == 0) {
                return this.appartments;
            } else {
                let newAppartmentsHome = [];
                if (this.res != 'empty' && this.res.length != 0) {
                    this.res.forEach(item =>{
                        newAppartmentsHome.push(item);
                    })
                }
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
            .get('http://127.0.0.1:8000/api/appartments/pagination')
            .then(res=> {
                    this.appartments=res.data.data;
                    axios
                        .get('http://127.0.0.1:8000/api/appartment/promotion')
                        .then(res=> {
                            this.promotedApps = res.data;
                            this.loading=false;
                        })
                        .catch(err=> {
                            console.log(err);
                        })
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
@import '../../sass/app.scss';

    .ms-img-container {
        //width: 300px;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        img{
            width: 100%;
            
        }
    }
    .ms-adress-color{
        color: gray;
    }
    .ms-router-color{
        color:black;
        transition: all 0.3s;
        &:hover{
            text-decoration: none;
            color: $primary-color;
        }
    }

    // @media all and (max-width: 576px){
    //   img {
    //     width: 100%; 
    //   } 
    // }
</style>