<template>
    <form class="ms-form my-lg-0 mt-5">
        <input class="ms-input px-4 my-2 " placeholder="Start your search"
        v-model="searchedText">
        <button class="ms-btn my-2 my-sm-0" type="submit"
        @click.prevent="postLocation(newRadius)">
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
    props: ['newRadius'],
    data(){
        return{
            searchedText: '',
            searchedApps: [],
            results: [],
            radius: 0
        }
    },
    methods:  {
        postLocation: function(rad){
            this.searchedApps=[];
            if (this.searchedText!=''){
                 axios
                .post('http://127.0.0.1:8000/api/locations', {
                    params: {
                        query: this.searchedText,
                        radius: rad
                    }
                })
                .then(res=> {
                    this.searchedText='';
                    this.results = res.data;
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
                this.searchedApps = newArray;
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