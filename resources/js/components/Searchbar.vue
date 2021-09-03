<template>
    <form class="ms-form my-lg-0 mt-5">
        <input class="ms-input px-4 my-2 " placeholder="Start your search"
        v-model="searchedText">
        <button class="ms-btn my-2 my-sm-0" type="submit"
        @click="postLocation">
            <router-link 
                :to="{
                    name:'locations'
                }">
                <i class="fas fa-search"></i>
            </router-link>
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
            lon: '',
            urlBase: 'https://api.tomtom.com/search/2/search/.json?key=Wmvv8LcCconSzj3Au7GbL9IGLjQLUCeM'
        }
    },
    methods:  {
        postLocation: function(){
            //this.searchedApps.push(this.searchedText);
            axios
                .post('http://127.0.0.1:8000/api/locations', {
                    params: {
                        query: this.searchedText 
                    }
                })
                .then(res=> {
                    this.lat=res.data.latitude;
                    this.lon=res.data.longitude;
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

                    this.searchedApps = res.data.filter(
                        (element, i )=> {
                            return (element.longitude == this.lon && element.latitude == this.lat);   
                        }
                    );
                    this.$emit('searchedApps',this.searchedApps);
                    // console.log(this.searchedApps);
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