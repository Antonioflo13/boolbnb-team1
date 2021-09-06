<template>
  <section>
        <div class="container">
            <div class="mt-5 d-flex  justify-content-between align-items-center flex-wrap">
                <Searchbar class="mb-2"
                    @searchedApps="searchedApps"
                    @searchedText="searchedText"
                    :newRadius="radius"
                />
                <button class="ms-btn-filter" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-2x fa-sort-amount-down-alt mx-4"></i>
                </button>
            </div>  
            <!-- Filter -->
            <div class="mt-4 col">
                <div class="collapse mt-3" id="collapseExample">
                    <div class="card card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="flex-fill mb-5">
                                <h4>Rooms and Beds</h4>
                                <div class="d-flex">
                                    <!-- Select Beds -->
                                    <div>
                                        <h6>Beds</h6>
                                        <select class="custom-select" v-model="selectOptionBeds">
                                            <option selected>Select</option>
                                            <option :value="bed" v-for='(bed, index) in bedsN'
                                                    :key='index'>{{bed}}</option>
                                        </select>
                                    </div>
                                    <!-- Select Rooms -->
                                    <div class="ml-4">
                                        <h6>Rooms</h6>
                                        <select class="custom-select" v-model="selectOptionRooms">
                                            <option selected>Select</option>
                                            <option :value="room" v-for='(room, index) in roomsN'
                                                    :key='index'>{{room}}</option>
                                        </select>    
                                    </div>
                                </div>
                            </div>
                            <div class="flex-fill ">
                                <h4>Distance</h4>
                                <label for="customRange1">KM range</label>
                                <span>( {{ (radius / 1000).toFixed(0) }} Km )</span>
                                <input type="range" class="custom-range" min="0" max="100000" id="customRange1" v-model="radius" @click.prevent="apiCall()">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4>Additional Services </h4>
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="form-check ms-form-check"
                                    v-for='(service, index) in services'
                                    :key='index'>
                                    <input class="form-check-input" type="checkbox"  id="defaultCheck1">
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
                <!-- Appartments searched in search bar -->
                <!-- <div class="d-flex flex-column mb-4"
                v-if="searchedApps != undefined">
                    <div class=" ms-appartment-container mt-4"
                    v-for='(searchedApp, index) in searchedApps'
                    :key='index'> 
                        {{searchedApp}}
                    </div>
                </div>  -->
                <!-- All Appartments -->
                <div class="d-flex flex-column mb-4">
                    <div class=" ms-appartment-container mt-4"
                    v-for='(appartment, index) in selectedAppartments'
                    :key='index'>
                        <div class="col col-sm-3 ms-img-container" >
                            <img :src="appartment.image" :alt="appartment.title" v-if="appartment.image.substr(0,5) == 'https'">
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
    //props: ['searchedApps'],
    data(){
        return {
            appartments:[],
            services: [],
            roomsN: [],
            bedsN: [],
            res: [],
            results: [],
            radius: 0,
            query: '',
            //dati recuperati dalla search bar
            //searchedApps: this.$route.query.app,
            // current_page: 2,
            // last_page:1
            selectOptionRooms:'Select',
            selectOptionBeds: 'Select'
        }
    },
    created: function() {
        this.getAppartments();
        this.getServices();
        //this.getRooms();
    },
    computed: {
        selectedAppartments: function() {
            if(this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select" && this.res.length==0 && this.res != 'empty') {
                return this.appartments;            
            } else if(this.res.length == 0 && this.res != 'empty'){
                let newAppartments = this.appartments.filter(
                    (element, i)=>{
                        if(this.selectOptionBeds != "Select"  && this.selectOptionRooms == "Select"){
                            return element.beds_number == this.selectOptionBeds;
                        } else if (this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select") {
                            return element.rooms_number == this.selectOptionRooms;
                        } else {
                            return (element.beds_number == this.selectOptionBeds && element.rooms_number == this.selectOptionRooms )
                        }
                    }     
                )
                return newAppartments;  
            } else if (this.res != 'empty') { 
                let newAppartment = [];
                this.appartments.forEach(element => {
                    this.res.forEach(item =>{
                        if(item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select"){
                            newAppartment.push(element);
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms == "Select") {
                            if (this.selectOptionBeds == item.beds_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select") {
                            if (this.selectOptionRooms == item.rooms_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms != "Select") {
                            if (this.selectOptionRooms == item.rooms_number && this.selectOptionBeds == item.beds_number) {
                                newAppartment.push(element);
                            }
                        }
                    })
                });
                return newAppartment;
            } else {
                let newAppartment = [];
                return newAppartment;
            }
        }
    } ,  
    
    methods: {
        searchedText: function(res) {
            this.query = res;
        },
        apiCall: function() {
            this.postLocation();
        },
        searchedApps: function(res){
            this.res=res;
        },
        //API Appartments
        getAppartments: function() {
            axios
                // .get(`http://127.0.0.1:8000/api/appartments?page=${page}`)
                .get('http://127.0.0.1:8000/api/appartments')
                .then(
                    res=>{
                        //Get appartments
                        this.appartments = res.data;

                        //Create rooms array
                        var rooms =[]
                        for(var i=0; i<this.appartments.length; i++){
                            if(!rooms.includes(this.appartments[i]['rooms_number'])){
                                rooms.push(this.appartments[i]['rooms_number']);
                            }
                        };
                        this.roomsN=rooms.sort();
                        
                        //Create Beds Array
                        var beds =[]
                        for(var i=0; i<this.appartments.length; i++){
                            if(!beds.includes(this.appartments[i]['beds_number'])){
                                beds.push(this.appartments[i]['beds_number']);
                            }
                        }
                        this.bedsN=beds.sort();
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

        postLocation: function(){
            axios
                .post('http://127.0.0.1:8000/api/locations', {
                    params: {
                        query: this.query,
                        radius: this.radius
                    }
                })
                .then(res=> {
                    this.results = res.data;
                    this.getApps();
                })
                .catch(err=> {
                    console.log(err);
                })
        },
        
        getApps: function() {
            axios
            .get(('http://127.0.0.1:8000/api/appartments'))
            .then(res=> {
                const newArray = [];
                if (this.results.length > 0) {
                    this.results.forEach(element => {
                        res.data.forEach(item => {
                            if (element.longitude == item.longitude && element.latitude == item.latitude) {
                                newArray.push(item);
                            }
                        });
                    });
                }
                this.res = newArray;
                if (this.res.length == 0) {
                    this.res = 'empty';
                }
            })
            .catch(err=> {
                console.log(err);
            })
        }
   
    }

}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';
    .ms-btn-filter {
            height: 50px;
            background-color: white;
            color: gray;
            border: 1px solid gray;
            border-radius: 35px;
            -webkit-border-radius: 35px;
            -moz-border-radius: 35px;
            -ms-border-radius: 35px;
            -o-border-radius: 35px;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            -ms-transition: all 0.2s;
            -o-transition: all 0.2s;
            &:hover{
                border: 1px solid #f82e53;
                color: #f82e53;
            }
            &:active{
                border: 1px solid #f82e53;
                color: #f82e53;
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