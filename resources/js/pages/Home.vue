<template>

    <div>


        <main>
        <div class="container-fluid">
            <div class="container">
                
                <!-- welcome message -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="col-md-8">
                        <h1>Welcome!</h1>
                        <h5>Today's posts</h5>
                    </div>

                    <!-- filter -->
                    <div>
                        <input type="text" class="form-input" placeholder="Search" v-model="searchPost" @keydown.enter="filterPost">
                    </div>
                    <!-- /filter -->

                </div>
                <!-- /welcome message -->

                
                <!-- pagination -->
                <!-- alla funzione getPosts passo la pagina corrente che, al click, cambierà tra previous e next e viceversa -->
                <nav aria-label="pag">
                    <ul class="pagination d-flex justify-content-center mt-3">
                        <li class="page-item"><a class="page-link" href="#" @click="getPosts(pagination.current_page -1)">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#" @click="getPosts(pagination.current_page +1)">Next</a></li>
                    </ul>
                </nav>
                <!-- /pagination -->
                
                <!-- post -->
                <div class="row justify-content-center text-center mt-5">
                    <div class="card" style="width: 40rem;">

                        <!-- v-for -->
                        <!-- imgs random per ogni post.id ad ogni refresh -->
                        <div class="card-body" v-for="post in posts" :key="post.id">
                            <img class="profile-pic rounded" :src="'https://unsplash.it/300/300?p=' + post.id" alt="post_img"> 
                            <h5 class="card-title fw-bold my-3">{{post.title}}</h5>
                            <p class="card-text">{{post.content}}</p>
                            <p class="card-text">Author: {{post.user.name}}
                            <br>
                            Date: {{getDate(post.updated_at)}}
                            <br>
                            Last update: {{getDate(post.last_update_at)}}

                            <!-- category -->
                            <p v-if="post.category" class="card-text">Category: {{post.category.type}}</p> 
                            <p v-else>Category: none</p> 
                            <!-- /category -->

                            <!-- tags -->
                            <div class="d-flex justify-content-center">
                                <div v-for="tag in post.tags" :key="tag.id" >
                                    <span v-if="tag.name" class="badge badge-pink mx-1 mb-3">#{{tag.name}}</span>
                                    <p v-else>Tags: none</p>
                                </div>
                            </div>
                            <!-- /tags -->

                            <!-- link to post details -->
                            <router-link :to="{ name:'posts.show', params: { post: post.slug } }">Dettagli</router-link>
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

        
    </main>
    </div>
  
</template>

<script>
import dayjs from 'dayjs';
import axios from 'axios';



export default {
    name: "Main",
    data() {
        return {
            posts: [], // array vuoto che verrà popolato con chiamata api
            pagination: {},   // variabile dove salvo il valore corrente della pagination
            searchPost: '',   // variabile vuota che verrà popolata dall'input text di filter
        }
    },
    methods:{
        getPosts(page, searchPost){        // passando come argomento ->page -> poi posso includerlo come querystring nella mia chiamata api e far funzionare la funzione paginate
            
            axios.get('http://127.0.0.1:8000/api/posts?page=' + page + searchPost).then((Response) =>{
                this.pagination = Response.data;
                this.posts = Response.data.data;
                console.log(Response.data.data);
            })
        },
        getDate(date){
            return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
        },
        filterPost(){
            this.getPosts(1, this.searchPost);    // richiamo la funzione getPosts e gli passo 2 argomenti (la pagina di riferimento e la stringa da ricercare)
        },
    },
    mounted(){
        this.getPosts();
    },
}
</script>

<style lang="scss" scoped>

</style>