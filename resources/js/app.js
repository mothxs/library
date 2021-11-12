require('./bootstrap');

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import books from '../pages/books/main.vue';
import createBook from '../pages/books/create-modal.vue';
import editBook from '../pages/books/edit-modal.vue';
import deleteBook from '../pages/books/delete-modal.vue';

import authors from '../pages/authors/main.vue';
import createAuthor from '../pages/authors/create-modal.vue';
import editAuthor from '../pages/authors/edit-modal.vue';
import deleteAuthor from '../pages/authors/delete-modal.vue';

import editorials from '../pages/editorials/main.vue';
import createEditorial from '../pages/editorials/create-modal.vue';
import editEditorial from '../pages/editorials/edit-modal.vue';
import deleteEditorial from '../pages/editorials/delete-modal.vue';

import partners from '../pages/partners/main.vue';
import createPartner from '../pages/partners/create-modal.vue';
import editPartner from '../pages/partners/edit-modal.vue';
import deletePartner from '../pages/partners/delete-modal.vue';

import rents from '../pages/rents/main.vue';
import createRent from '../pages/rents/create-modal.vue';
import extendRent from '../pages/rents/extend-modal.vue';
import returnRent from '../pages/rents/return-modal.vue';


//Books page
Vue.component('books', books);
Vue.component('create-book-modal', createBook);
Vue.component('edit-book-modal', editBook);
Vue.component('delete-book-modal', deleteBook);

//Authors page
Vue.component('authors', authors);
Vue.component('create-author-modal', createAuthor);
Vue.component('edit-author-modal', editAuthor);
Vue.component('delete-author-modal', deleteAuthor);

//Editorials page
Vue.component('editorials', editorials);
Vue.component('create-editorial-modal', createEditorial);
Vue.component('edit-editorial-modal', editEditorial);
Vue.component('delete-editorial-modal', deleteEditorial);

//Partners page
Vue.component('partners', partners);
Vue.component('create-partner-modal', createPartner);
Vue.component('edit-partner-modal', editPartner);
Vue.component('delete-partner-modal', deletePartner);

//Rents page
Vue.component('rents', rents);
Vue.component('create-rent-modal', createRent);
Vue.component('extend-rent-modal', extendRent);
Vue.component('return-rent-modal', returnRent);

new Vue({
    el: '#app'
})