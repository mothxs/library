require('./bootstrap');

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import books from '../components/books/main.vue';
import createBooks from '../components/books/create-modal.vue';
import editBooks from '../components/books/edit-modal.vue';

import authors from '../components/authors/main.vue';
import createAuthors from '../components/authors/create-modal.vue';
import editAuthors from '../components/authors/edit-modal.vue';
import deleteAuthors from '../components/authors/delete-modal.vue';

Vue.component('books', books);
Vue.component('create-books-modal', createBooks);
Vue.component('edit-books-modal', editBooks);
Vue.component('authors', authors);
Vue.component('create-authors-modal', createAuthors);
Vue.component('edit-authors-modal', editAuthors);
Vue.component('delete-authors-modal', deleteAuthors);

new Vue({
    el: '#app'
})