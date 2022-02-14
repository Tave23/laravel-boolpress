<template>
   <!-- sidebar -->
      <div class="sidebar">
         <div class="categories">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
         </div>
         <div class="tags">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
         </div>
      </div>
</template>

<script>
export default {
   name: "Sidebar"
}
</script>

<style lang="scss" scoped>

.sidebar{
   width: 20%;
   margin:35px 0 0 15px;
   .categories, .tags{
      height: 30%;
      width: 100%;
      border: 2px solid lightseagreen;
      border-radius: 15px;
      padding: 10px;
   }
   .categories{
      margin-bottom: 10px;
   }
   span{
      display: inline-block;
      background-color: lightseagreen;
      padding: 2px 5px;
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