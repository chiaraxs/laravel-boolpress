<template> 
   <div> 
       <!-- vue navbar in resources/js/components -->
       <Navbar></Navbar>
       <!-- / vue navbar in resources/js/components -->
            
        <!-- router-view che rimanda al componente indicato dal router per quella specifica rotta (home | contacts ) -->
        <router-view></router-view>
        <!-- router-view -->
        
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

