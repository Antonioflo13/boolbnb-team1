<template>
    <div id="contact">
        <div class="modal-dialog" v-show="success">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-success">
                        <p>The message has been send successfully, thank you for contacting us. We will reply to you within 24h</p>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ms-btn" data-dismiss="modal" @click.prevent="success=false">
                        Close
                    </button>    
                </div>
            </div>
        </div>
        <h3 class="mt-4">Send Us a Message</h3>
        
        <!-- <div class="alert alert-success" v-show="success">
          <p>The message has been send successfully, thank you for contacting us. We will reply to you within 24h</p>
        </div> -->
        <form @submit.prevent="sendForm">
            <div class="d-flex ">
                <div class="form-group mr-1 ms-items">
                    <!-- <label for="name">Name</label> -->
                    <input type="text" class="form-control" id="name"  placeholder="Name" v-model= "name" :class="{ 'is-invalid' :errors.name}">
                    <small
                        v-for="(error, index) in errors.name"
                        :key="`name-err-${index}`"
                        class="text-danger">
                        {{error}}
                    </small>
                </div>
                <div class="form-group ml-1 ms-items">
                    <!-- <label for="email">Email address</label> -->
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="name@example.com" v-model='email' :class="{ 'is-invalid' :errors.name}">
                    <small
                        v-for="(error, index) in errors.email"
                        :key="`email-err-${index}`"
                        class="text-danger">
                        {{error}}
                    </small>
                </div>
            </div>
            
            <div class="form-group">
                <!-- <label for="message">Your Message</label> -->
                <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..." v-model="message" :class="{ 'is-invalid' :errors.name}"></textarea>
                <small
                    v-for="(error, index) in errors.message"
                    :key="`message-err-${index}`"
                    class="text-danger">
                    {{error}}
                </small>
            </div>
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I have read and agree to <a href="">Privacy Policy</a></label>
            </div> -->
            <button type="submit" class="btn ms-btn" :disabled="sending"> {{(sending)?'Sending':'Send'}} </button>
        </form> 
    </div> 
</template>

<script>
export default {
    name: 'Contact',
    props: ['msgApp'],
    data(){
        return{
        name:'',
        email: '',
        message:'',
        appartment: this.msgApp.id,
        user: this.msgApp.user_id,
        errors: {},
        success:false,
        sending:false
        }
    },
    methods: {
        sendForm: function(){
        this.sending=true;
        axios.post(`http://127.0.0.1:8000/api/messages`, {
            name: this.name,
            email:this.email,
            message: this.message,
            appartment_id: this.msgApp.id,
            user_id: this.user
        })
        .then(
            res=> {
            this.sending=false;
            if(res.data.errors) {
                //se compare al meno un errore di validazione
                this.errors=res.data.errors;
                this.success=false;
            } else {
                //salvo il lead nel db
                this.errors = {},
                this.name ='',
                this.email='',
                this.message='',
                this.appartment_id = this.msgApp.id,
                this.success=true
            }
            }
        )
        .catch(
            err=> {
            console.log(err);
            }
        )
        }
    }
}
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';
    h3 {
        color: $primary-color;
    }
    .ms-items{
        flex-grow:1;
    }
    i{
        color: $primary-color;
    }
    
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