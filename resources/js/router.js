// 1. import
import Vue from "vue";
import VueRouter from "vue-router";    // vueRouter -> vue plugin
import Home from './pages/home.vue';
import Contacts from './pages/contacts.vue';
import Show from './pages/posts/Show.vue'

// 2. dichiarazione utilizzo VueRouter in Vue
Vue.use(VueRouter);

// 3. vueRouter instances
// la chiave 'routes' -> accetta solo un array di oggetti->le rotte
const router = new VueRouter({
    mode: 'history',           // la metodologia history-> elimina il # dall'url
    routes: [
        {
            path: '//',     // il doppio slash -> serve perchè con il singolo slash non riconsce la rotta alla home
            component: Home,
            name: 'home.index',
            meta: { title: 'Homepage', linkText: 'Home' }
        },  // homepage route  -> http://127.0.0.1:8000/
        {
            path: '/contacts',
            component: Contacts,
            name: 'contacts.index',
            meta: { title: 'Contacts', linkText: 'Contacts' }
        },  // contacts route -> http://127.0.0.1:8000/contacts
        {
            path: '/posts/:post',   // parametro dinamico
            component: Show,
            name: 'posts.show',
            meta: {title: 'Details'}
        }
    ],
});

// 5.
router.beforeEach((to, from, next) => {
    document.title = to.meta.title;  // 1. prima assegna un title per ogni meta

    next(); // 2. e poi vai avanti
})

// 4. instance export -> la rende pubblica e accessibile dall'esterno -> da vue.js
export default router;