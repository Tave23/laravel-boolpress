<template>
   <!-- sidebar -->
      <div class="sidebar">
         <div class="categories">
            <h4>Categorie</h4>
            <span
            v-for="category in categories" :key="`categ${category.id}`"
            @click="$emit('getPostBy', category.slug )">
               {{category.name}}
            </span>
         </div>
         <div class="tags">
            <h4>Tags</h4>
            <span
            v-for="tag in tags" :key="`tag${tag.id}`"
            @click="$emit('getPostBy', tag.slug )">
               {{tag.name}}
            </span>
         </div>
      </div>
</template>

<script>
export default {
   name: "Sidebar",
   props:{
      'tags': Array,
      'categories': Array,
   }
}
</script>

<style lang="scss" scoped>

.sidebar{
   width: 20%;
   margin:35px 0 0 15px;
   .categories, .tags{
      height: 30%;
      min-height: 150px;
      width: 100%;
      border: 2px solid lightseagreen;
      border-radius: 15px;
      padding: 10px;
   }
   .categories{
      margin-bottom: 10px;
   }
   h4{
      padding: 3px 5px;
   }
   span{
      display: inline-block;
      background-color: lightseagreen;
      padding: 3px 5px;
      margin: 5px;
      border-radius: 5px;
      cursor: pointer;
      &:hover{
         color: white;
         background-color: rgb(41, 223, 214);
         transition: 0.3s;
      }
   }
}
</style>