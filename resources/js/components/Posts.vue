<template>
   <div class="container">

      <!-- lato sx per lista posts -->
      <div class="blog-side">

         <div
         v-if="success">

            <h3>{{ title }}</h3>

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

         <div v-else>
            <h3>{{error_msg}}</h3>
         </div>

      </div>

      <Sidebar 
      :tags="tags"
      :categories="categories"
      @getPostByCateg="getPostByCateg"
      @getPostByTag="getPostByTag"
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
         success: true,
         error_msg: '',
         title: 'Ecco la lista dei Post'
      }
   },
   mounted(){
      this.printPosts();
   },
   methods:{
      getPostByCateg(slug_category){
         this.reset();
         console.log(slug_category);
         axios.get(this.urlApi + '/category/' + slug_category)
         .then(response => {
            // console.log(response.data.category.posts);
            this.posts = response.data.category.posts
            this.title = 'Ecco i post con la categoria: ' + response.data.category.name

            if (!response.data.success) {
               this.success = false;
               this.error_msg = response.data.console.error();
            }

         })
      },
      getPostByTag(slug_tag){
         this.reset();
         console.log(slug_tag);
         axios.get(this.urlApi + '/tag/' + slug_tag)
         .then(response => {
            // console.log(response.data.category.posts);
            this.posts = response.data.tag.posts
            this.title = 'Ecco i post con il tag: ' + response.data.tag.name

            if (!response.data.success) {
               this.success = false;
               this.error_msg = response.data.console.error();
            }

         })
      },
      printPosts(page = 1){
         this.reset();
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
      },
      reset(){
         this.success = true;
         this.error_msg = '';
         this.posts = null;
         this.title = 'Ecco la lista dei Post'
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