// 1. import
import Vue from "vue";
import VueRouter from "vue-router";    // vueRouter -> vue plugin
import Home from './pages/home.vue';
import Contacts from './pages/contacts.vue';

// 2. dichiarazione utilizzo VueRouter in Vue
Vue.use(VueRouter);

// 3. vueRouter instances
// la chiave 'routes' -> accetta solo un array di oggetti->le rotte
const router = new VueRouter({
    routes: [
        { path: '/', component: Home, name: 'home.index' },  // homepage route 
        { path:'/contacts', component: Contacts, name: 'contacts.index'},  // contacts route 
    ],
});


// 4. instance export -> la rende pubblica e accessibile dall'esterno -> da vue.js
export default router;