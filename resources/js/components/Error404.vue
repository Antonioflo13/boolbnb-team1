<template>
    <div id="ms_error404">
        <h1>Error 404</h1>
        <p>Ops... The page was not found!</p>
        <router-link :to="{name: 'home'}">Home</router-link>
    </div>
</template>

<script>
export default {
    name: 'Error404'
}
</script>

<style lang="scss" scoped>
    @import '../../sass/app.scss';

    #ms_error404 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: calc(100vh - 148.66px);

        h1 {
            text-transform: uppercase;
            font-size: 30px;
            font-weight: 700;
            color: $primary-color;
        }

        p {
            font-size: 24px;
        }

        a {
            padding: 5px 20px;
            border-radius: 10px;
            border: 2px solid $primary-color;
            text-transform: uppercase;
            text-decoration: none;
            font-weight: 700;
            color: $primary-color;
            transition: background-color .3s, color .3s;

            &:hover {
                color: $secondary-color;
                background-color: $primary-color;
            }
        }
    }
</style>