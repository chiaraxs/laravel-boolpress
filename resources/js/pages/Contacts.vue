<template>
  
    <div class="container">
        
        <!-- form -->
        <!-- se il form non è settato a false -> mostralo -->
        <div v-if="!formSubmitted">
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Insert your name" v-model="formData.name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Insert your mail" v-model="formData.email">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Your message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="formData.message"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-plum" @click="formSubmit">Send</button>
            </div>
        </div>
        <!-- /form -->

        <!-- error message -->
        <!-- mostriamo l'errore solo se è settato a false -->
        <div v-else class="alert alert-success py-5 mt-5 text-center">
            <h3>Thanks for contacting us!</h3>
            <p>We will reply as soon as possible!</p>
        </div>
        <!-- /error message -->

    </div>

</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            formSubmitted: false,   // variabile che controlla se mostrare il form o il messaggio dopo l'invio con submit
            formData: {
                name: '',
                email: '',
                message: '',
            },
        };
    },
    methods: {
        async formSubmit(){

            try{
                const Response = await axios.post('http://127.0.0.1:8000/api/contacts', this.formData);
                Response.data;
                this.formSubmitted = true;
            } 
            catch(error){
                alert ('Warning! There was an error in our system. Try again and check your data.')
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>