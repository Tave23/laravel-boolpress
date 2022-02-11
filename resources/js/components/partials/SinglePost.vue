<template>
   <article>
      <h4>
         <strong>
            <router-link :to="{name: 'singlePostInfo', params:{slug: post.slug}}">
               {{ post.title_post }}
            </router-link>
         </strong>
      </h4>
      <p class="data">{{ updateDate }}</p>
      <p class="content">{{ post.content }}</p>
   </article>
</template>

<script>
export default {
   name: "SinglePost",
   props:{
      'post': Object
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
   }
}
</script>

<style lang="scss" scoped>
h4{
   margin: 25px 0 5px;
}
.data{
   font-size: 12px;
   font-style: italic;
   margin-bottom: 15px;
}
article{
   a{
      text-decoration: none;
      color: black;
      &:hover{
         color: blue;
      }
   }
}
</style>