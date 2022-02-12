// importare vue
import Vue from "vue";

// importare vue router
import VueRouter from "vue-router";

// usare VueRouter
Vue.use(VueRouter);

// importare lista delle rotte che usiamo
import Home from './components/pages/Home';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import Main from './components/partials/Main';
import SinglePostInfo from './components/pages/SinglePostInfo';
import Error404 from './components/pages/Error404'; 


const router = new VueRouter({
   mode: 'history',
   linkExactActiveClass: 'active',

   // lista rotte
   routes:[
      {
         path: '/',
         name: 'home',
         component: Home,
      },
      {
         path: '/chi-siamo',
         name: 'about',
         component: About,
      },
      {
         path: '/contatti',
         name: 'contacts',
         component: Contacts,
      },
      {
         path: '/posts-list',
         name: 'blog',
         component: Main,
      },
      {
         path: '/info/:slug',
         name: 'singlePostInfo',
         component: SinglePostInfo,
      },
      {
         // rotta per gestione pagina non trovata.
         // DA METTERE IN FONDO!!!
         // * a significare "tutte le rotte" - nome inutile visto che non va linkato da nessuna parte
         path: '*',
         component: Error404,
      },

   ]
})

// obbligatorio esportare
export default router;