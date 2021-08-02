<template>
  <div class="container">
    <Header/>

    <main>
      <h1>Il mio blog</h1>
      <div class="row">
        <Card
          v-for="post in posts"
          :key="post.id"
          :item="post"
        />
        <!-- <div 
        v-for="post in posts"
        :key="post.id"
        class="col-4 my-4 d-flex">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ post.title }}</h4>
              <p>{{ truncateText(post.content, 200) }}</p>
              <a href="#" class="card-link">Leggi</a>
            </div>
          </div>
        </div> -->
      </div>
      <div 
      class="text-center mb-4">
        <button 
        v-show="current_page > 1"
        class="btn btn-info"
        @click="getPosts(current_page - 1)"
        >
          Prev
        </button>

        <button
        class="btn mr-3"
        :class="(n == current_page) ? 'btn-primary' : 'btn-info'"
        v-for="n in last_page"
        :key="n"
        @click="getPosts(n)"
        >
          {{ n }}
        </button>

        <button 
        v-show="current_page < last_page"
        class="btn btn-info"
        @click="getPosts(current_page + 1)"
        >
          Next
        </button>

      </div>
    </main>

    <Footer/>
  </div>
  
</template>

<script>
// import axios from 'axios';
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import Card from './components/Card.vue';
// import WorkInProgress from './components/WorkInProgress.vue';

export default {
    name: 'App',
    data: function() {
      return {
        posts:[],
        current_page: 1,
        last_page: 1,
      }
    },
    components: {
      Header,
      Footer,
      Card
    },
    methods: {
      truncateText: function(string, charsNumber = 100) {
        if(string.lenght > charsNumber) {
          return string.substr(0, charsNumber) + '...';
        } else {
          return string;
        }
      },

      getPosts: function(page = 1) {
        axios
        .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
        .then(
          res => {
            console.log(res.data);
            this.posts = res.data.data;
            this.current_page = res.data.current_page;
            this.last_page = res.data.last_page;

            this.posts.forEach(
              element => {
                element.excerpt = this.truncateText(element.content, 100)
              }
            )
          }
        )
        .catch(
          err => {
            console.log(err);
          }
        );
      }
    },
    created: function() {
      this.getPosts();
    }
}
</script>

<style lang="scss">
  @import '../sass/front.scss';
</style>