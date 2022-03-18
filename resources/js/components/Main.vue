<template>

    <main>
        <div class="container-fluid">
            <div class="container">
                
                <!-- welcome message -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="col-md-8">
                        <h1>Welcome!</h1>
                        <h5>Today's posts</h5>
                    </div>
                </div>
                <!-- /welcome message -->

                <!-- post -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="card" style="width: 40rem;">

                        <!-- v-for -->
                        <div class="card-body" v-for="post in posts" :key="post.id">
                            <img class="profile-pic rounded" src="https://unsplash.it/300/300" alt="post_img"> 
                            <h5 class="card-title fw-bold my-3">{{post.title}}</h5>
                            <p class="card-text">{{post.content}}</p>
                            <p class="card-text">Author: {{post.user.name}}
                            <br>
                            Date: {{post.created_at}}</p>

                            <!-- category -->
                            <p v-if="post.category" class="card-text">Category: {{post.category.type}}</p> 
                            <p v-else>Category: none</p> 
                            <!-- /category -->

                            <!-- tags -->
                            <div class="d-flex justify-content-center" v-for="tag in post.tags" :key="tag.id" >
                                <span v-if="tag.name" class="badge badge-pink mx-1 mb-3">#{{tag.name}}</span>
                                <p v-else>Tags: none</p>
                            </div>
                            <!-- /tags -->

                            <!-- link to post details -->
                            <a href="#">Details</a>
                            <!-- /link to post details -->
                            
                            <!-- hr separatore per ogni post  -->
                            <hr style="height:3px">
                            <!-- /hr separatore per ogni post -->

                        </div>
                        <!-- /v-for -->
                    </div>
                </div>
                <!-- /post -->

            </div>
        </div>

        <!-- pagination -->
        <!-- alla funzione getPosts passo la pagina corrente che, al click, cambierà tra previous e next e viceversa -->
        <nav aria-label="pag">
            <ul class="pagination d-flex justify-content-center mt-3">
                <li class="page-item"><a class="page-link" href="#" @click="getPosts(pagination.current_page -1)">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#" @click="getPosts(pagination.current_page +1)">Next</a></li>
            </ul>
        </nav>
        <!-- /pagination -->
    </main>
    
</template>

<script>
import axios from 'axios';

export default {
    name: "Main",
    data() {
        return {
            posts: [], // array vuoto che verrà popolato con chiamata api
            pagination: {}   // variabile dove salvo il valore corrente della pagination
        }
    },
    methods:{
        getPosts(page){        // passando come argomento ->page -> poi posso includerlo come querystring nella mia chiamata api e far funzionare la funzione paginate
            
            axios.get('http://127.0.0.1:8000/api/posts?page=' + page).then((Response) =>{
                this.pagination = Response.data;
                this.posts = Response.data.data;
                console.log(Response.data.data);
            })
        }
    },
    mounted(){
        this.getPosts();
    }
}
</script>


<style lang="scss" scoped>


a{
   color: #FF69B4;
}
</style>