<template>
   <main>

      <h2>Home con Vue - Blog</h2>

      <Posts />

   </main>
</template>

<script>

import Posts from '../Posts.vue'

export default {
   name: "Main",
   components:{
      Posts
   }
}
</script>

<style lang="scss" scoped>
h2{
   text-align: center;
   margin-top: 20px;
}

main{
   overflow-y: scroll;
   height: 50vw;
}
</style>