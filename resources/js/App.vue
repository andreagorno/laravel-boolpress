<template>
  <div class="container">
    <Header/>

    <main>
      <!-- component matched by the route will render here -->
      <router-view></router-view>
    </main>

    <Footer/>
  </div>
  
</template>

<script>
// import axios from 'axios';
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
// import Card from './components/Card.vue';
// import WorkInProgress from './components/WorkInProgress.vue';

export default {
    name: 'App',

    components: {
      Header,
      Footer,
      // Card
    },
}
</script>

<style lang="scss">
  @import '../sass/front.scss';
</style>