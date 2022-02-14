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
   width: 30%;
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
}
</style>