<template>
  
  <div>
      Details
      <h1>{{post.title}}</h1>
      <p>{{post.content}}</p>
  </div>

</template>

<script>
import axios from 'axios';


export default {
    data(){
        return {
            post: {}
        };
    },
    methods: {
        getPost(){
            axios.get('/api/posts/' + this.$route.params.post);
                this.post = Response.data;     // chiamata api per recuperare i dettagli dei singoli posts
            }
    },
    mounted(){
        this.getPost();
    }
}
</script>

<style  lang="scss" scoped>

</style>