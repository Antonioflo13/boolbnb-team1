<template>
  <section>
        <div class="container">
            <div class="mt-5 col">
                <Searchbar/>
            </div>  
            <!-- Filter -->
            <div class="mt-4 col">
                <button class="ms-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-filter"></i>
                </button>
                    
                <div class="collapse mt-3" id="collapseExample">
                    <div class="card card-body">
                        <div>
                            <h4>Rooms and Beds</h4>
                            <select class="custom-select">
                                <option selected>Select</option>
                                <option value="1" v-for='(service, index) in services'
                                    :key='index'>{{service.rooms_number}}</option>
                                <!-- <option value="2">Two</option>
                                <option value="3">Three</option> -->
                            </select>
                        </div>
                        <div>
                            <h4 class="mt-3">Distance</h4>
                            <label for="customRange1">Example range</label>
                            <input type="range" class="custom-range" id="customRange1">
                            <form>
                                <!-- <div class="form-group">
                                    <label for="formControlDistance">Distance</label>
                                    <input type="range" class="form-control-range" id="formControlDistance">
                                </div> -->
                            </form>
                        </div>
                        <div class="mt-3">
                            <h4>Additional Services </h4>
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="form-check ms-form-check"
                                    v-for='(service, index) in services'
                                    :key='index'>
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{service.name}}
                                    </label>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
             <!-- Content     -->
            <h3 class="mt-5"><strong>In evidence</strong></h3>
            <h3 class="mt-5"><strong>Live anywhere</strong></h3>
            <div class="row">
                <div class="d-flex flex-column mb-4">
                    <!-- Da aggiornare in modo dinamico -->
                    <div class=" ms-appartment-container mt-4"
                    v-for='(appartment, index) in appartments'
                    :key='index'>
                        <div class="col col-sm-3 ms-img-container" >
                            <img :src="appartment.image" :alt="appartment.title" v-if="appartment.image.substr(0,5) == 'https'">
                            <!-- {{appartment.image.substr(0,5)}} -->
                            <img :src="'http://127.0.0.1:8000/storage/'  + appartment.image" :alt="appartment.title" v-else>
                        </div>
                        <div class="col col-sm-3">
                            <h5 class="mt-3 ">{{appartment.title}}</h5>
                        </div>
                        <div class="col col-sm-6">
                            <p class="mt-3 ">{{ textExerpt(appartment.description) }}</p>
                            <button type="submit" class="btn">
                                <router-link :to="{name: 'single-location', params: { slug: appartment.slug}}">View details</router-link>
                            </button>
                        </div>    
                    </div>
                </div>   
            </div>     
        </div>
  </section>
</template>

<script>
import Searchbar from '../components/Searchbar';
export default {
    name:"Locations",
    components: {
        Searchbar
    },
    data(){
        return {
            appartments:[],
            services: [],
            rooms: [],
            beds: []
            // current_page: 2,
            // last_page:1
        }
    },
    created: function() {
        this.getAppartments();
        this.getServices();
        //this.getRooms();
    },
    methods: {
        //API Appartments
        getAppartments: function() {
            axios
                // .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .get('http://127.0.0.1:8000/api/appartments')
                .then(
                    res=>{
                        //Get appartments
                        this.appartments = res.data;
                        //Create rooms array
                        for(var i=0; i<this.appartments.length; i++){
                            this.rooms.push(this.appartments[i]['rooms_number']);
                        }
                        //Create Beds Array
                        for(var i=0; i<this.appartments.length; i++){
                            this.rooms.push(this.appartments[i]['beds_number']);
                        }
                        // this.current_page = res.data.current_page;
                        // this.last_page = res.data.last_page
                    }
                )
                .catch(
                    err=>console.log(err)
                )
        },
        textExerpt: function(str) {
            if(str.length >100) {
                
                return str.substr(0, 100)+'...';
            } else {
                return str;
            }
        },
        //API Services
        getServices: function() {
            axios
                .get('http://127.0.0.1:8000/api/services')
                .then(
                    res=>{
                        this.services = res.data;
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
    .ms-btn {
            width: 50px;
            height: 50px;
            background-color: white;
            color: #FD395C;
            border: 1px solid #FD395C;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            -ms-transition: all 0.2s;
            -o-transition: all 0.2s;
            &:hover{
                background-color: #f82e53;
                border: 1px solid #f82e53;
                color: white;
            }
        }

    img {
        width: 100%;
        border-radius: 10px;
    }
    .ms-form-check{
        width: 100%;
    }
    
    @media all and (min-width: 768px){
        .ms-appartment-container{
            display: flex;
            align-items: top;
        };
        .ms-form-check{
            width: 25%;
        }
    }


</style>