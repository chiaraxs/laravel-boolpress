<template> 
   <div> 
       <!-- vue navbar in resources/js/components -->
       <Navbar></Navbar>
       <!-- / vue navbar in resources/js/components -->
            
        <!-- router-view che rimanda a resources/js/pages/home.vue -> è uguale a vue main in resources/js/components -->
        <router-view></router-view>
        <!-- vue main in resources/js/components -->
        
        <!-- vue footer in resources/js/components -->    
        <Footer></Footer>
        <!-- vue footer in resources/js/components --> 
    </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';



export default {
  components: { 
        Navbar, 
        Footer,
    }
}
</script>

<style lang="scss" scoped>



</style>

