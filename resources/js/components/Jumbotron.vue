<template>
    <section id="ms-jumbotron" class="d-flex flex-column justify-content-center align-items-center py-5">
        <div class="my-5 d-flex flex-column justify-content-center align-items-center">
            <Searchbar 
                @searchedApps="searchedApps"
                @searchedText="searchedText"

            />
            <h3 class="text-center my-5 px-3">Want to explore more? Perfect!</h3>
            <router-link v-if="(query.length > 0)" :to="{name: 'locations', params: { slug: query } }">
                <button type="submit" class="ms-style px-5 py-3">Advanced Search </button>
            </router-link>
            <router-link v-else :to="{name: 'locations'}">
                <button type="submit" class="ms-style px-5 py-3">Advanced Search </button>
            </router-link>
        </div>
    </section> 
</template>

<script>
import Searchbar from './Searchbar';

export default {
    name: "Jumbotron",
    components: {
        Searchbar
    },
    data () {
        return {
            query: '',
        }
    },
    methods: {
        searchedApps: function(res) {
            
            this.$emit('searchedApps', res);
        },
        searchedText: function(res) {
            this.query = res;
        }
    }
   

}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';

</style>