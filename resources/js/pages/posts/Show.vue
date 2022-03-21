<template>
  
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    
                    <!-- title  -->
                    <div class="card-header d-flex title text-center">
                        {{post.title}}
                    </div>
                    <!-- /title -->

                    <!-- content  -->
                    <div class="card-body">
                        {{post.content}}
                    </div>
                    <!-- /content -->

                    <!-- dettagli user -->
                    <div>
                        <p class="ms-3"> User: {{ post.user.name }} 
                        <br>
                        Mail: {{ post.user.email }}</p>
                    </div>
                    <!-- dettagli user  -->

                    <!-- dettagli ora/data post  -->
                    <div>
                        <p class="ms-3 fw-light"><span class="text-decoration-underline">Post details:</span>
                            <br>
                            Update: {{getDate(post.updated_at)}}
                            <br>
                            Last update: {{getDate(post.last_update_at)}}
                        </p>
                    </div>
                    <!-- dettagli ora/data post  -->

                    <!-- category -->
                    <div>
                        <p v-if="post.category" class="card-text ms-3">Category: {{post.category.type}}</p> 
                        <p class="ms-3" v-else>Category: none</p> 
                    </div>
                    <!-- /category -->

                    <!-- tags -->
                    <div class="d-flex justify-content-center">
                        <div v-for="tag in post.tags" :key="tag.id" >
                            <span v-if="tag.name" class="badge badge-pink mx-1 mb-3">#{{tag.name}}</span>
                            <p v-else>Tags: none</p>
                        </div>
                    </div>
                    <!-- /tags -->

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import axios from 'axios';
import dayjs from 'dayjs';


export default {
    data(){
        return {
            post: {}
        };
    },
    methods: {
        getPost(){
            axios.get('/api/posts/' + this.$route.params.post).then(Response=>{
            this.post = Response.data}); // chiamata api per recuperare i dettagli dei singoli posts
        },
        getDate(date){
            return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
        },
    },
    mounted(){
        console.log(this.$route.params.post);
        this.getPost();
    }
}
</script>

<style  lang="scss" scoped>

</style>