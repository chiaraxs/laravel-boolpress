<template> 
   <div> 
       <!-- vue navbar in resources/js/components -->
       <Navbar></Navbar>
       <!-- / vue navbar in resources/js/components -->
            
        <!-- vue main in resources/js/components -->
        <Main></Main>
        <!-- vue main in resources/js/components -->
        
        <!-- vue footer in resources/js/components -->    
        <Footer></Footer>
        <!-- vue footer in resources/js/components --> 
    </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';

export default {
  components: { 
        Navbar, 
        Main,
        Footer,
    }
}
</script>

<style lang="scss" scoped>



</style>

