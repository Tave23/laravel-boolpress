<template>
   <div class="singlePost">

      <div class="image-side">

      </div>

      <div class="text-side">
         <h4>
            <strong>
               <router-link :to="{name: 'singlePostInfo', params:{slug: post.slug}}">
                  {{ post.title_post }}
               </router-link>
            </strong>
         </h4>
         <p class="data">{{ updateDate }}</p>
         <p class="content">{{ post.content }}</p>
      </div>

   </div>
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
.singlePost{
   a{
      text-decoration: none;
      color: black;
      &:hover{
         color: lightseagreen;
      }
   }
}

.singlePost{
   border: 1px solid lightgray;
   border-radius: 10px;
   padding: 0 10px 10px;
   display: flex;
   .image-side{
      width: 30%;
   }
   .text-side{
      width: 70%;
   }
}
</style>