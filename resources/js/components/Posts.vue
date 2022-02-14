<template>
   <div class="container">

      <!-- lato sx per lista posts -->
      <div class="blog-side">

         <h3>Ecco la lista dei Post</h3>

         <div v-if="posts">

            <SinglePost 
            v-for="post in posts"
            :key="`post${post.id}`"
            :post="post"
            />

            <!-- bottone pagina precedente -->
            <button
            @click="printPosts(pages.current - 1)"
            :disabled="pages.current === 1"
            >Prev Page</button>

            <!-- bottoni nuemri pagine -->
            <button
            v-for="page in pages.last"
            :key="`buttons ${page}`"
            @click="printPosts(page)"
            :disabled="pages.current === page">
            {{page}}
            </button>

            <!-- bottone pagina successiva -->
            <button
            @click="printPosts(pages.current + 1)"
            :disabled="pages.current === pages.last"
            >Next Page</button>
         </div>
         
         <div v-else>
            <Loading />
         </div>

      </div>

      <Sidebar 
      :tags="tags"
      :categories="categories"
      @getPostBy="getPostBy"
      />
   </div>
</template>

<script>

import SinglePost from './partials/SinglePost.vue';
import Loading from './partials/Loading.vue';
import Sidebar from './partials/Sidebar.vue';

export default {
   name: "Posts",
   components:{
      SinglePost,
      Loading,
      Sidebar
   },
   data(){
      return{
         urlApi: 'http://127.0.0.1:8000/api/posts',
         pagination: '?page=',
         posts: null,
         pages: {},
         tags: [],
         categories:[],
      }
   },
   mounted(){
      this.printPosts();
   },
   methods:{
      getPostBy(slug_category){
         console.log(slug_category);
         axios.get(this.urlApi + '/category/' + slug_category)
         .then(response => {
            console.log(response.data.category.posts);
            this.posts = response.data.category.posts
         })
      },
      printPosts(page = 1){
         axios.get(this.urlApi + this.pagination + page)
         .then(result => {
            // stampo i post
            this.posts = result.data.posts.data;
            // stampo i tags
            this.tags = result.data.tags;
            // stampo le categories
            this.categories = result.data.categories;
            console.log(this.tags, this.categories);
            // console.log(result.data.posts);
            this.pages = {
               current : result.data.posts.current_page,
               last : result.data.posts.last_page
            }
         })
      }
   }
}
</script>

<style lang="scss" scoped>
h3{
   padding: 35px 0;
}

.container{
   width: 65%;
   margin: 10px auto 0;
   display: flex;
   .blog-side{
      width: 80%;
   }
   button{
      margin: 20px 10px;
      background-color: lightseagreen;
      border: 1px solid black;
      padding: 5px;
      border-radius: 10px;
      &:hover{
         background-color: rgb(0, 82, 82);
         color: white;
         transition: all 0.3s;
      }
      &:disabled{
         background-color: lightgrey;
         color: black;
      }
   }
   
}
</style>