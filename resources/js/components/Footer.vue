<template>
    <footer>
        <div class="container ms-footer py-3">
            <div class="row">
                <div class="col">
                    <ul class="d-flex flex-wrap ms-footer-links align-items-center my-2">
                        <li class="ms-list-group mr-3"> &copy; 2021 Boolbnb, Inc. </li> 
                        <li class="ms-list-group mr-3"><a href="#">Privacy</a> </li>
                        <li class="ms-list-group mr-3"><a href="#">Terms</a></li>
                        <li class="ms-list-group mr-3"><a href="#">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col ms-social">
                    <ul class="d-flex flex-row-reverse align-items-center my-2">
                        <li class="ms-list-group mr-3"><a href="#"><i class="fab fa-2x fa-instagram"></i></a></li>
                        <li class="ms-list-group mr-3"><a href="#"><i class="fab  fa-2x fa-twitter"></i></a> </li>
                        <li class="ms-list-group mr-3"> <a href="#"><i class="fab fa-2x fa-facebook-f"></i></a></li>   
                    </ul>

                </div>
            </div> 
        </div>
    </footer>
</template>

<script>
export default {
    name:'Footer'

}
</script>

<style lang="scss" scoped>
    @import '../../sass/app.scss';
</style>