<template>
  <section class="mb-5">
        <div class="container">
            <h2 class="mt-5 col">{{appartment.title}}</h2>
            <div class="col d-flex flex-wrap align-items-center">
                <i class="fas fa-map-marker-alt"></i>
                <p class="ml-3 mb-0">Lignano Sabbiadoro</p>
            </div>
            <div class="col col-lg-8 mt-4" >
                <img :src="appartment.image" :alt="appartment.title" v-if="appartment.image.substr(0,5) == 'https'">
                <img :src="'http://127.0.0.1:8000/storage/'  + appartment.image" :alt="appartment.title" v-else>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h3 class="mt-3">Description</h3>
                    <p class="">{{appartment.description}}</p>
                    <h4 class="mt-3">Additional Services</h4>
                    <div class="d-flex flex-wrap">
                        <h4 class="mr-2 badge badge-info" v-for='(service, index) in appartment.services' :key="index">
                            {{service.name}}
                        </h4>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <Contact/>
                </div>
            </div>
            
        </div>
      
  </section>
</template>

<script>
import Contact from '../components/Contact';
export default {
    name: 'SingleLocation',
    components: {
        Contact
    },
    data(){
        return{
            appartment: []
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
                        console.log(res.data);
                        this.appartment=res.data;
                        //this.loading=false;
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
    }
    i{
        color: $primary-color;
    }

</style>