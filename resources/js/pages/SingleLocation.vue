<template>
  <section class="mb-5">
        <div class="container" v-if="!loading && JSON.stringify(post) !='{}'">
            <div class="row">
                <h2 class="mt-5 col-12">{{appartment.title}}</h2>
                <div class="d-flex col-12 justify-content-between align-items-center">
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fas fa-map-marker-alt"></i>
                        <p class="ml-3 mb-0">{{appartment.address}}</p>
                    </div>
                    <router-link :to="{name: 'locations'}" class="" >
                        <button type="submit" class="btn"><i class="fas fa-arrow-right fa-2x"></i></button>
                    </router-link>
                </div>
                
                <div class="col-12 col-lg-8 mt-3" >
                    <!-- <img :src="appartment.image" :alt="appartment.title" v-if="appartment.image.substr(0,5) == 'https'"> -->
                    <img :src="'http://127.0.0.1:8000/storage/'  + appartment.image" :alt="appartment.title">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h3 class="mt-4 mb-3">Description</h3>
                    <p class="">{{appartment.description}}</p>
                    <div class="d-flex flex-wrap align-items-center " >
                        <div class="d-flex flex-wrap align-items-center mt-1 mb-1 mr-4" >
                            <i class="fas fa-house-user"></i>
                            <p class="ml-2 mb-0 ms-adress-color">{{appartment.rooms_number}} rooms</p>
                        </div>
                        <div class="d-flex flex-wrap align-items-center mt-1 mb-1 mr-4" >
                            <i class="fas fa-bed"></i>
                            <p class="ml-2 mb-0 ms-adress-color">{{appartment.beds_number}} beds</p>
                        </div>
                    </div>
                    <h4 class="mt-3">Additional Services</h4>
                    <div class="d-flex flex-wrap">
                        <h4 class="mr-2 badge badge-info" v-for='(service, index) in appartment.services' :key="index">
                            {{service.name}}
                        </h4>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <Contact
                    :msgApp="appartment"/>
                </div>
            </div>
        </div>
        <Loader v-else/>   
    </section>
</template>

<script>
import Contact from '../components/Contact';
import Loader from '../components/Loader'
export default {
    name: 'SingleLocation',
    components: {
        Contact,
        Loader
    },
    data(){
        return{
            appartment: [],
            loading:true
        }
    },
    created() {
            this.getPost(this.$route.params.slug);
        },

    methods: {
        getPost(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/appartments/${slug}`)
                .then(
                    res=> {
                        //console.log(res.data);
                        this.appartment=res.data;
                        this.loading = false;
                    }
                )
                .catch(
                    err=>console.log(err)
                )
        },
        
    }
}

</script>

<style scoped lang="scss">
@import '../../sass/app.scss';
    img{
        width: 100%;
        border-radius: 10px;
    }
    .fa-arrow-right{
            color: gray;
            transition: all 0.2s;
            &:hover{
                color: $primary-color;
            }

        }

</style>