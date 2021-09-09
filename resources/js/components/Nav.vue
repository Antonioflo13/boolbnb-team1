<template>
    <nav class="navbar bg-white sticky-top navbar-expand-lg navbar-light">
        <div class="container">
            <router-link :to="{name: 'home'}" class="navbar-brand d-flex align-items-center">
              <img class='ms-logo mr-2' src="/images/logo.png" alt="Logo"> 
              <strong class="ms-text ml-3"> boolbnb </strong>
            </router-link>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <router-link :to="{name: 'home'}" class="nav-link d-flex align-items-center"> Home </router-link>
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
    }
}
</script>

<style lang="scss" scoped>
    @import '../../sass/app.scss';
</style>