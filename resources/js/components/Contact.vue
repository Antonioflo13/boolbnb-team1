<template>
    <div id="contact">
        <h3 class="mt-4">Send Us a Message</h3>
        <form action="">
            <div class="d-flex ">
                <div class="form-group mr-1 ms-items">
                    <!-- <label for="name">Name</label> -->
                    <input type="text" class="form-control" id="name"  placeholder="Name" >
                </div>
                <div class="form-group ml-1 ms-items">
                    <!-- <label for="email">Email address</label> -->
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="name@example.com" >
                </div>
            </div>
            
            <div class="form-group">
                <!-- <label for="message">Your Message</label> -->
                <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..." ></textarea>
            </div>
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I have read and agree to <a href="">Privacy Policy</a></label>
            </div> -->
            <button type="submit" class="btn ms-btn"> Send </button>
        </form> 
    </div> 
</template>

<script>
export default {
    name: 'Contact'

}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';
    // .form-control{
    //     border: 2px solid $primary-color;
    // }
    h3 {
        color: $primary-color;
    }
    .ms-items{
        flex-grow:1;
    }
    // a{
    //     color:white;
    //     text-decoration:none;
    //     transition: all 0.3s;
    //     &:hover{
    //         color: #fa697c;
    //     }
    // }
    


    .ms-btn {
        width: 100%;
        border: 1px solid $primary-color;
        color: $primary-color;
        transition: all 0.3s;

        &:hover {
            background-color: $primary-color-hover;
            color: white;
        }

    }

</style>