<template>
    <section class="my-5">
        <h1>Il nostro Blog</h1>

        <div class="row">
            <Card
            v-for="post in posts"
            :key="post.id"
            :item="post"
            />
        
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
    </section>
</template>

<script>
import Card from '../components/Card.vue';


export default {
    name: 'Blog',
    components: {
        Card
    },
    data: function() {
      return {
        posts:[],
        current_page: 1,
        last_page: 1,
      }
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
    @import '../../sass/front.scss';
</style>