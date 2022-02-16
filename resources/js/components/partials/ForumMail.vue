<template>
   <div class="forum">
      <h3>Scrivici!</h3>

      <form @submit.prevent="sendMail">

         <div class="field">
            <label for="name">
               Inserisci il tuo nome
            </label>
            <input type="text" v-model="name">
            <p v-if="errors.name" class="errors">
               {{ errors.name[0] }}
            </p>
         </div>

         <div class="field">
            <label for="email">
               Inserisci la tua mail
            </label>
            <input type="email" v-model="email">
            <p v-if="errors.email" class="errors">
               {{ errors.email[0] }}
            </p>
         </div>

         <div class="field">
            <label for="msg">
               Scrivi qui il tuo messaggio
            </label>
            <textarea id="" cols="30" rows="10" v-model="msg">      
            </textarea>
            <p v-if="errors.msg" class="errors">
               {{ errors.msg[0] }}
            </p>
         </div>

         <button type="subit" :disabled="sending">
            {{ sending ? 'Invio in corso...' : 'Invio' }}
         </button>

         <h4 class="sended" v-if="sended">
            Email inviata correttamente, ti risponderemo il prima possibile!
         </h4>

      </form>
   </div>
</template>

<script>
import axios from "axios"

export default {
   name: 'ForumMail',
   data(){
      return{
         name: '',
         email: '',
         msg:'',
         errors:{},
         sending: false,
         sended: false
      }
   },
   methods:{
      sendMail(){
         this.sending = true;
         this.sended = false;
         axios.post('api/contacts',{
            'name': this.name,
            'email': this.email,
            'msg': this.msg,
         }).then(response => {
            this.sending = false;

            if (!response.data.success) {
               this.errors = response.data.errors
            }else{
               this.sended = true,
               this.errors = {},
               this.name = '',
               this.email = '',
               this.msg = ''
            }
         });
      }
   }
}
</script>

<style lang="scss" scoped>

.forum{
   margin-top: 50px;
   h3{
      margin: 10px 0;
   }
   label{
      display: block;
      margin-top: 15px;
   }
   textarea, input{
      width: 100%;
      margin-bottom: 3px;
   }
   textarea{
      margin-bottom: 10px;
   }
   .errors{
      color: red;
      font-size: 11px;
   }
   button{
      margin: 25px 0;
      border: none;
      background-color: rgb(19, 102, 98);
      padding: 5px 10px;
      color: white;
      border-radius: 5px;
      cursor: pointer;
      &:hover{
         background-color: lightseagreen;
         color: black;
         transition: 0.3s;
      }
   }
   .sended{
      color: green;
   }
}

</style>