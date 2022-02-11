<template>
   <header>

      <nav>
         <h3>Un bellissimo Header</h3>
         <ul>
            <li>
               <a href="#">Home</a>
            </li>
            <li>
               <a href="#">Contattaci</a>
            </li>
            <li>
               <a href="#">Chi siamo</a>
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
         }
      }
   }
}

</style>