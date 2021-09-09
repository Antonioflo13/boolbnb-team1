<template>
  <section>
        <div class="container">
            <div class="mt-5 d-flex  justify-content-between align-items-center flex-wrap">
                <Searchbar class="mb-2"
                    @searchedApps="searchedApps"
                    @searchedText="searchedText"
                    :newRadius="radius"
                />
                <!-- <button class="ms-btn-filter px-5" type="button" @click.prevent="selectedAppartments = appartments">
                    Reset
                </button> -->
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
                                <span>( {{ radius }} Km )</span>
                                <input type="range" class="custom-range" min="20" max="100" id="customRange1" v-model="radius" @click.prevent="apiCall()">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4>Additional Services </h4>
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="form-check ms-form-check"
                                    v-for='(service, index) in services'
                                    :key='index'>
                                    <input class="form-check-input" type="checkbox" :value="service.id" v-model="checked" :id="service.name">
                                    <label class="form-check-label" :for="service.name">
                                        {{service.name}}
                                    </label>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
             <!-- Content     -->
            <h3 class="mt-5"><strong>Live anywhere</strong></h3>
            <div class="row">
                <div class="d-flex flex-column mb-4" v-if="(!loading && JSON.stringify(selectedAppartments) !='{}')">
                    <div v-if="selectedAppartments.length>0">
                        <div class=" ms-appartment-container mt-4"
                        v-for='(appartment, index) in selectedAppartments'
                        :key='index' >
                            <div class="col col-sm-3 ms-img-container mb-3">
                                <img :src="appartment.image" :alt="appartment.title" v-if="appartment.image.substr(0,5) == 'https'">
                                <img :src="'http://127.0.0.1:8000/storage/'  + appartment.image" :alt="appartment.title" v-else>
                            </div>
                            <div class="col col-sm-5 mb-3">
                                <h5 class="">{{appartment.title}}</h5>
                                <div class="d-flex flex-wrap align-items-center mt-3 mb-1" >
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="ml-2 mb-0 ms-adress-color"><small>{{appartment.address}}</small></p>
                                </div>
                                <div class="d-flex flex-wrap align-items-center mt-2 mb-1" >
                                    <div class="d-flex flex-wrap align-items-center mt-1 mb-1 mr-4" >
                                        <i class="fas fa-house-user"></i>
                                        <p class="ml-2 mb-0 ms-adress-color"><small>{{appartment.rooms_number}} rooms</small></p>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center mt-1 mb-1 mr-4" >
                                        <i class="fas fa-bed"></i>
                                        <p class="ml-2 mb-0 ms-adress-color"><small>{{appartment.beds_number}} beds</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-4">
                                <p class="">{{ textExerpt(appartment.description) }}</p>
                                <router-link :to="{name: 'single-location', params: { slug: appartment.slug}}">
                                    <button type="submit" class="btn ms-btn-view">View details</button>
                                </router-link>    
                            </div>    
                        </div>
                    </div>
                    <div class="mt-4 mb-4 col" v-else >
                        <div class="d-flex flex-wrap align-items-center">
                            <i class="fas fa-exclamation-circle mr-2 fa-2x mb-3"></i>
                            <p class="">No appartments exists with the selected criteria, please select different criteries</p>
                        </div> 
                    </div> 
                </div> 
                <Loader v-else/> 
            </div>     
        </div>
    </section>

</template>

<script>
import Searchbar from '../components/Searchbar';
import Loader from '../components/Loader';

export default {
    name:"Locations",
    components: {
        Searchbar,
        Loader
    },
    data(){
        return {
            appartments:[],
            services: [],
            roomsN: [],
            bedsN: [],
            res: [],
            results: [],
            radius: 20,
            appartmentNumber: 20,
            query: '',
            loading:true,
            selectOptionRooms:'Select',
            selectOptionBeds: 'Select',
            checked:[],
        }
    },
    created: function() {
        this.getAppartments();
        this.getServices();
    },
    computed: {
        selectedAppartments: function() {
            if(this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select" && this.res.length==0 && this.res != 'empty' && this.checked.length == 0) {
                return this.appartments;            
            } else if(this.res.length == 0 && this.res != 'empty'){
                let newAppartments = this.appartments.filter(
                    (element, i)=>{
                        if(this.selectOptionBeds != "Select"  && this.selectOptionRooms == "Select" && this.checked.length == 0){
                            return element.beds_number == this.selectOptionBeds;
                        } else if (this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select" && this.checked.length == 0) {
                            return element.rooms_number == this.selectOptionRooms;
                        } else if (this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            return !arrayTest3.includes(false);
                        } else if (this.selectOptionBeds != "Select" && this.selectOptionRooms == "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            return (element.beds_number == this.selectOptionBeds && !arrayTest3.includes(false))
                        } else if (this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            return (element.rooms_number == this.selectOptionRooms && !arrayTest3.includes(false))
                        } else {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            return (element.beds_number == this.selectOptionBeds && element.rooms_number == this.selectOptionRooms && !arrayTest3.includes(false))
                        }
                    }     
                )
                return newAppartments;  
            } else if (this.res != 'empty') { 
                let newAppartment = [];
                this.appartments.forEach(element => {
                    this.res.forEach(item =>{
                        if(item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select" && this.checked.length == 0){
                            newAppartment.push(element);
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms == "Select" && this.checked.length == 0) {
                            if (this.selectOptionBeds == item.beds_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select" && this.checked.length == 0) {
                            if (this.selectOptionRooms == item.rooms_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms != "Select" && this.checked.length == 0) {
                            if (this.selectOptionRooms == item.rooms_number && this.selectOptionBeds == item.beds_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms == "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            if (!arrayTest3.includes(false)) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms == "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            if (!arrayTest3.includes(false) && this.selectOptionBeds == item.beds_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds == "Select" && this.selectOptionRooms != "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            if (!arrayTest3.includes(false) && this.selectOptionRooms == item.rooms_number) {
                                newAppartment.push(element);
                            }
                        } else if (item.id == element.id && this.selectOptionBeds != "Select" && this.selectOptionRooms != "Select" && this.checked.length > 0) {
                            let arrayTest = [];
                            element.services.forEach(service => {
                                arrayTest.push(service.id);
                            });
                            let arrayTest2 = [];
                            this.checked.forEach(id => {
                                arrayTest2.push(id);
                            });
                            let arrayTest3 = [];
                            arrayTest2.forEach(id => {
                                arrayTest3.push(arrayTest.includes(id));
                            });
                            if (!arrayTest3.includes(false) && this.selectOptionRooms == item.rooms_number && this.selectOptionBeds == item.beds_number) {
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
        // resetFilters: function(){
        //     selectedAppartments() = this.appartments
        // },
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
                .get(`http://127.0.0.1:8000/api/appartments/pagination?number=${this.appartmentNumber}`)
                .then(
                    res=>{
                        //Get appartments
                        this.appartments = res.data.data;
                        this.loading=false;

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
                axios 
                    .post('http://127.0.0.1:8000/api/distance', {
                        params: {
                            appartments: res.data,
                            coordinate: this.results,
                            radius: this.radius
                        }
                    })
                    .then(res=> {
                        this.res = res.data;
                        if (this.res.length == 0) {
                            this.res = 'empty';
                        }
                    })
                    .catch(err=> {
                        console.log(err);
                    })
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
    .ms-btn-view {
        color: white;
        background-color: $primary-color;
        &:hover{
            background-color: $primary-color-hover;
            color: white;
        }
    }
    .ms-img-container{
        height: 200px;
        overflow: hidden;
        border-radius: 10px;

        img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
    }
    .ms-adress-color{
        color: gray;
    }
    
    .fa-exclamation-circle{
        color: $primary-color;
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