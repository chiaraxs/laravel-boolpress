<template>
  
    <div class="container mt-5">
        
        <!-- form -->
        <!-- se il form non è settato a false -> mostralo -->
        <div v-if="!formSubmitted">
            
            <!-- name -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Insert your name" v-model="formData.name">

                <!-- segnalazione errore nome -->
                <span class="text-danger" v-if="formErrors && formErrors.name">{{formErrors.name}}</span>
                <!-- /segnalazione errore nome -->
            </div>
            <!-- /name -->

            <!-- email -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Insert your mail" v-model="formData.email">

                <!-- segnalazione errore mail -->
                <span class="text-danger" v-if="formErrors && formErrors.email">{{formErrors.email}}</span>
                <!-- /segnalazione errore mail -->
            </div>
            <!-- /email -->

            <!-- message -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Your message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="formData.message"></textarea>

                <!-- segnalazione errore message -->
                <span class="text-danger" v-if="formErrors && formErrors.message">{{formErrors.message}}</span>
                <!-- /segnalazione errore message -->
            </div>
            <!-- /message -->

            <!-- submit button -->
            <div>
                <button type="submit" class="btn btn-plum" @click="formSubmit">Send</button>
            </div>
            <!-- /submit button -->
            
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
            formErrors: null,     // variabile in cui salvo gli errori nel form -> di default è settata a null
        };
    },
    methods: {
        async formSubmit(){

            try{
                this.formErrors = null; // resetto la variabile formErrors ad ogni refresh e la riporto a null

                const Response = await axios.post('http://127.0.0.1:8000/api/contacts', this.formData);
                Response.data;
                this.formSubmitted = true;
            } 
            catch(error){

                if(error.response.status === 422){   // 422: errore di validazione nel form
                    this.formErrors = error.response.data.errors;   // qui salvo gli errori nella variabile -> formErrors
                }
                
                alert ('Warning! There was an error in our system. Try again and check your data.');
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>