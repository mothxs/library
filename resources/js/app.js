require('./bootstrap');

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import books from '../components/books/main.vue';
import createBooks from '../components/books/create-modal.vue';

Vue.component('books', books);
Vue.component('create-books-modal', createBooks);

new Vue({
    el: '#app'
})