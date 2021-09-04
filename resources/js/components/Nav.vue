<template>
    <nav class="navbar sticky-top bg-white navbar-expand-lg navbar-light" :class="{ 'onScroll bg-transparent': topOfPage}">
        <div class="container">
            <router-link :to="{name: 'home'}" class="navbar-brand d-flex align-items-center">
              <img class='ms-logo mr-2' src="/images/logo.png" alt="Logo"> 
              <strong class="ms-text ml-3"> boolbnb </strong>
            </router-link>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <!-- <Searchbar/> -->
                <form class="ms-form my-lg-0 mt-5" :class="{ 'onScrollSearch': topOfPage}">
                    <input class="ms-input px-4 my-2 " placeholder="Start your search"
                    v-model="searchedText">
                <button class="ms-btn my-2 my-sm-0" type="submit"
                @click.prevent="postLocation()">
                <router-link
                    :to="{name:'locations'}">
                <i class="fas fa-search"></i>
                </router-link>
                </button>
                </form>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/register">Become a host</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/login"><i class="fas fa-2x fa-user-circle"></i></a>
                    </li>   
                </ul>  
            </div>
        </div>   
    </nav>
</template>

<script>
import Searchbar from './Searchbar';
export default {
    name: "Nav",
    components: {
        Searchbar
    },
    data(){
        return{
            searchedText: '',
            searchedApps: [],
            lat:'',
            lon: '',
            topOfPage: true
        }
    },
    methods:  {
        postLocation: function(){
            this.searchedApps=[];
            if (this.searchedText!=''){
                 axios
                .post('http://127.0.0.1:8000/api/locations', {
                    params: {
                        query: this.searchedText 
                    }
                })
                .then(res=> {
                    this.searchedText='';
                    this.lat=res.data.latitude;
                    this.lon=res.data.longitude;
                    this.getApps();
                })
                .catch(err=> {
                    console.log(err);
                })
            }
        },
        
        getApps: function() {
            axios
            .get(('http://127.0.0.1:8000/api/appartments'))
            .then(res=> {
                    this.searchedApps = res.data.filter(
                        element => {
                            return (element.longitude == this.lon && element.latitude == this.lat);   
                        }
                    );
                    if (this.searchedApps.length == 0) {
                        this.searchedApps = 'empty';
                    }
                    this.$emit('searchedApps',this.searchedApps);
                })
                .catch(err=> {
                    console.log(err);
                })
        },
        scrolling(){
            if(window.pageYOffset>5){
            if(this.topOfPage) this.topOfPage = false;
            } else {
            if(!this.topOfPage) this.topOfPage = true;
            }
        }                 
    },
    beforeMount() {
        window.addEventListener('scroll', this.scrolling);
    }
}
</script>

<style lang="scss" scoped>
    @import '../../sass/app.scss';
    @keyframes esempio {
    0% {}
    50% {top:50px; right:360px;}
    100% {top:165px; right:360px;}
    }
    .onScroll {
        position: relative;
    }
    .onScrollSearch {
        position: absolute;
        animation-name: esempio;
        animation-duration: 0.2s;
        animation-fill-mode: forwards;
        
    }
</style>