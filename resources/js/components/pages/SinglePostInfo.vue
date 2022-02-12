<template>
   <div class="container">

      <h2>{{this.post.title_post}}</h2>

      <h6 class="data">Creato il: {{ updateDate }}</h6>

      <h5
      v-if="this.post.category"
      >Categoria: {{ this.post.category.name }}</h5>

      <div
      class="tags"
      v-for="(tag, index) in post.tags" :key="`tag${index}`">
      <span>{{ tag.name }}</span></div>

      <p>{{ this.post.content }}</p>

      <router-link :to="{name: 'blog'}">Torna alla lista dei post</router-link>
   </div>
</template>

<script>
export default {
   name: "SinglePostInfo",
   data(){
      return{
         post:{
            title_post: '',
            category: '',
            tags: [],
            content: '',
            created_at: '',
         },
         apiUrl: 'http://127.0.0.1:8000/api/posts/',
         slug: this.$route.params.slug,
      }
   },
   mounted(){
      console.log(this.slug);

      this.getApi()
   },
   computed:{
      updateDate(){
         const d = new Date(this.post.created_at);
         let day = d.getDate();
         let months = d.getMonth() + 1;
         const year = d.getFullYear();

         if(day < 10) day = "0" + day;
         if(months < 10) months = "0" + months;

         return `${day} / ${months} / ${year}`;
      }
   },
   methods:{

      getApi(){
         axios.get(this.apiUrl + this.slug)
            .then(response =>{
               this.post = response.data;
               console.log(this.post);
            })
      }
   }
}
</script>

<style lang="scss" scoped>
   .container{
      width: 65%;
      min-height: 70vh;
      margin: 100px auto;
      h5{
         margin: 15px 0;
      }
      p{
         margin: 20px 0;
      }
      h2{
         margin-top: 15px;
      }
      .data{
         font-style: italic;
      }
      .tags{
         margin: 20px 0;
         display: inline-block;
         span{
            margin-right: 10px;
         }
      }
      span{
         padding: 8px;
         background-color: lightseagreen;
         border: 1px solid black;
      }
      
   }
</style>