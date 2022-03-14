<template> 
   <div> 
       <!-- vue navbar in resources/js/components -->
       <Navbar></Navbar>
       <!-- / vue navbar in resources/js/components -->
            
        <!-- view-> home.blade-->
        <div class="container">
            <div class="row justify-content-center text-center mt-5">
                <div class="col-md-8">
                    <h1>Benvenuto!</h1>
                </div>
            </div>
        </div>
        <!-- /view-> home.blade -->
        
        <!-- vue footer in resources/js/components -->    
        <Footer></Footer>
        <!-- vue footer in resources/js/components --> 
    </div>
</template>

<script>
import Footer from '../components/Footer.vue'
import Navbar from '../components/Navbar.vue'
    export default {
  components: { 
        Navbar, 
        Footer 
    }
}
</script>

<style lang="scss" scoped>



</style>

