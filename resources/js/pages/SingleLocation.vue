<template>
  <section>
      <h4>Ciao</h4>
  </section>
</template>

<script>
export default {
    name: 'SingleLocation',
    data(){
        return{
            appartment: null
        }
    },
    created() {
            this.getPost(this.$route.params.slug);
        },

    methods: {
        getPost(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/appartments/${slug}`)
                .then(
                    res=> {
                        console.log(res.data);
                        this.appartment=res.data;
                        //this.loading=false;
                    }
                )
                .catch(
                    err=>console.log(err)
                )
        },
        
    }
}

</script>

<style>

</style>