<template>
    <form class="ms-form my-lg-0 mt-5">
        <input class="ms-input px-4 my-2 " placeholder="Start your search">
        <button class="ms-btn my-2 my-sm-0" type="submit">
            <router-link 
                :to="{
                    name:'locations',
                    query: { app:searchedApps} 
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
            searchedApps: []
        }
    },
    //chiamata Axios legata alla location e i dati della chiamata che sono salavti in searchedApp

}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';
.fas{
    color: white;
}

</style>