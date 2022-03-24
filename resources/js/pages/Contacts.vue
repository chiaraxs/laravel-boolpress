<template>
  
    <div class="container">

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

</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            formData: {
                name: '',
                email: '',
                message: '',
            },
        };
    },
    methods: {
        formSubmit(){
            axios.post('http://127.0.0.1:8000/api/contacts').then((Response) =>{
                this.formData = Response.data;
            })
        },
    },
}
</script>

<style lang="scss" scoped>

</style>