<template>

    <main>
        <div class="container-fluid">
            <div class="container">
                
                <!-- welcome message -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="col-md-8">
                        <h1>Benvenuto!</h1>
                    </div>
                </div>
                <!-- /welcome message -->

                <!-- post -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="card" style="width: 40rem;">
                        <div class="card-body" v-for="post in posts" :key="post.id">
                            <img src="#" class="card-img-top" alt="post_img">
                            <h5 class="card-title">{{post.title}}</h5>
                            <p class="card-text">{{post.content}}</p>
                            <p class="card-text">Author: {{post.user.name}}</p>
                            <p class="card-text">Date: {{post.created_at}}</p>
                            <!-- <p class="card-text">Categories: {{post.category.type}}</p>  -->
                        </div>
                    </div>
                </div>
                <!-- /post -->

            </div>
        </div>
    </main>
    
</template>

<script>
import axios from 'axios';

export default {
    name: "Main",
    data() {
        return {
            posts: [] // array vuoto che verrà popolato con chiamata api
        }
    },
    methods:{
        getPosts(){
            axios.get('http://127.0.0.1:8000/api/posts').then((Response) =>{
                this.posts = Response.data;
            })
        }
    },
    mounted(){
        this.getPosts();
    }
}
</script>


<style lang="scss" scoped>

</style>