<template>
   <div>
      <Header />

      <!-- <Main /> -->
      <router-view></router-view>

      <Footer />
   </div>
</template>

<script>

// importo i componenti
import Header from './components/partials/Header.vue';
// import Main from './components/partials/Main.vue';
import Footer from './components/partials/Footer.vue';

export default {
   name: "App",
   components:{
      Header,
      // Main,
      Footer
   }
}
</script>

<style lang="scss">

</style>