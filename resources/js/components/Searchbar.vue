<template>
    <form class="ms-form my-lg-0">
        <input class="ms-input px-4 my-2 " placeholder="Start your search"
        v-model="searchedText">
        <button class="ms-btn my-2 my-sm-0" type="submit"
        @click.prevent="postLocation()">
            <router-link v-if="$route.name == 'locations'"
                :to="{name:'locations', params: { slug: searchedText } }">
            </router-link>
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
            rad : 20
        }
    },
    computed: {
        radius: function() {
            return this.newRadius;
        }
    },
    methods:  {
        postLocation: function(){
            if (this.$route.name == 'locations' && this.$route.params.slug != undefined && this.searchedApps == 0) {
                this.searchedText = this.$route.params.slug;
            }
            if (this.$route.name == 'locations' && this.$route.fullPath == '/locations') {
                this.$router.push('locations/' + this.searchedText).catch(()=>{});
            } else if (this.$route.name == 'locations' && this.$route.fullPath != '/locations') {
                this.$router.push(this.searchedText).catch(()=>{});
            }
            this.searchedApps=[];
            if (this.radius && this.radius != 0) {
                this.rad = this.radius;
            }
            if (this.searchedText!=''){
                 axios
                .post('http://127.0.0.1:8000/api/locations', {
                    params: {
                        query: this.searchedText,
                        radius: this.rad
                    }
                })
                .then(res=> {
                    this.$emit('searchedText', this.searchedText);
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
            .then(res => {
                axios 
                    .post('http://127.0.0.1:8000/api/distance', {
                        params: {
                            appartments: res.data,
                            coordinate: this.results,
                            radius: this.rad
                        }
                    })
                    .then(res=> {
                        this.searchedApps = res.data;
                        if (this.searchedApps.length == 0) {
                            this.searchedApps = 'empty';
                        }
                        this.$emit('searchedApps',this.searchedApps);
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
    mounted: function() {
        if (this.$route.name == 'locations' && this.$route.params.slug != undefined) {
            this.postLocation();
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