
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
//  */
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import BootstrapVue from 'bootstrap-vue'
require('./bootstrap');
Vue.use(VeeValidate);
Vue.use(Toaster, {timeout: 5000}) // for toaster notifications...
Vue.use(BootstrapVue)


window.Vue = require('vue');


import VueChatScroll from 'vue-chat-scroll' // for auto chat scroll , keeping the scroll position to the current message.
Vue.use(VueChatScroll)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('message-component', require('./components/MessageComponent.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('apply-component', require('./components/ApplyComponent.vue').default);
Vue.component('favorite-component', require('./components/FavouriteComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('home-search-component', require('./components/HomeSearchComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
      
        result: 'Good'
    
    },
    //created(){
    //     Echo.private('user')
    // .listen('NewJobCreatedNotification', (e) => {
       
    //    alert(JSON.stringify(e.job));
    //    console.log(e);
    // });

    //}
});
