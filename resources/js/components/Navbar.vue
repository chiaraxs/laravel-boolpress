<template>
    <nav class="navbar navbar-light bg-light navbar-expand-md shadow">
        <!-- container navbar -->
        <div class="container">

            <!-- vue router -> router-link -> crea un tag <a> al cui click rimanda alla rotta home ->  http://127.0.0.1:8000 -->
            <router-link :to="{name: 'home.index'}" class="nav-link">Boolpress</router-link>
            <!-- /vue router -> router-link -> crea un tag <a> al cui click rimanda alla rotta home ->  http://127.0.0.1:8000 -->

        <button
            class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-bs-controls="navbarSupportedContent" aria-bs-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <!-- vue router -> router-link -> crea un tag <a> al cui click rimanda alla rotta  http://127.0.0.1:8000/contacts -->
                    <!-- con il v-for e il mounted nei data, ciclo le rotte che ho dichiarato nell'istanza: home & contacts -->
                    <li class="nav-item" v-for="route in routes" :key="route.path">
                        <router-link :to="route.path" class="nav-link">{{route.meta.linkText}}</router-link>
                    </li>
                    <!-- /vue router -> router-link -->
                </ul>
                <!-- /Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login" v-if="!user">Login</a>
                        <a class="nav-link" href="/admin" v-else>{{user.name}}</a>
                    </li>
                    
                </ul>
                <!-- /Right Side Of Navbar -->  
            </div>
        </div>
        <!-- /container navbar -->
    </nav>
</template>



<script>
import axios from 'axios';

export default {
    name: 'Navbar',
    data(){
        return{
            routes: [],
            user: null,    // variabile fissata di default a null -> è not null quando l'utente è loggato
        }
    },
    methods: {
        getUser(){
            axios.get('/api/user').then(Response =>{
                this.user = Response.data;     // se l'utente è loggato, stampo i dettagli
            })
            .catch((error)=> {
                console.error('Not logged-in user');   // altrimenti -> error
            })
        },
    },
    mounted(){
        this.routes = this.$router.getRoutes().filter((route)=>route.meta.linkText);   
        // il getRoutes-> filtra e prende tutte le rotte che sono dichiarate nell'istanza in router.js -> restitutendo un true
        this.getUser();
    }
    
}
</script>



<style lang="scss" scoped>

</style>