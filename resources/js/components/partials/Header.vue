<template>
   <header>

      <nav>
         <h3>Un bellissimo Header</h3>
         <ul>
            <li>
               <router-link :to="{name: 'home'}">Home</router-link>
            </li>
            <li>
               <router-link :to="{name: 'blog'}">Posts</router-link>
            </li>
            <li>
               <router-link :to="{name: 'about'}">Chi siamo</router-link>
            </li>
            <li>
               <router-link :to="{name: 'contacts'}">Contatti</router-link>
            </li>
         </ul>
      </nav>

   </header>
</template>

<script>
export default {
   name: "Header"
}
</script>

<style lang="scss" scoped>

header{
   background-color: lightseagreen;
   position: fixed;
   top: 0;
   width: 100vw;
   nav{
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 20px;
   }
   ul{
      display: flex;
      li{
         margin-right: 20px;
         list-style-type: none;
         a{
            color: black;
            text-decoration: none;
            &:hover{
               text-decoration: underline;
            }
            &.active{
               text-decoration: underline 2px black;
            }
         }
      }
   }
}

</style>