<template>
    <form class="ms-form my-lg-0 mt-5">
        <input class="ms-input px-4 my-2 " placeholder="Start your search"
        v-model="searchedText">
        <button class="ms-btn my-2 my-sm-0" type="submit"
        @click.prevent="postLocation()">
            <!-- <router-link
                :to="{name:'locations'}">
            </router-link> -->
            <i class="fas fa-search"></i>
        </button>
    </form>
</template>

<script>
export default {
    name: 'Searchbar',
    data(){
        return{
            searchedText: '',
            searchedApps: [],
            lat:'',
            lon: ''
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
        }                 
    }
    

}
</script>

<style scoped lang="scss">
    @import '../../sass/app.scss';
    .fas{
        color: white;
    }

</style>