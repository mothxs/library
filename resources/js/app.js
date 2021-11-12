require('./bootstrap');

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import books from '../pages/books/main.vue';
import createBooks from '../pages/books/create-modal.vue';
import editBooks from '../pages/books/edit-modal.vue';
import deleteBooks from '../pages/books/delete-modal.vue';

import authors from '../pages/authors/main.vue';
import createAuthors from '../pages/authors/create-modal.vue';
import editAuthors from '../pages/authors/edit-modal.vue';
import deleteAuthors from '../pages/authors/delete-modal.vue';

import editorials from '../pages/editorials/main.vue';
import createEditorials from '../pages/editorials/create-modal.vue';
import editEditorials from '../pages/editorials/edit-modal.vue';
import deleteEditorials from '../pages/editorials/delete-modal.vue';

import partners from '../pages/partners/main.vue';
import createPartners from '../pages/partners/create-modal.vue';
import editPartners from '../pages/partners/edit-modal.vue';
import deletePartners from '../pages/partners/delete-modal.vue';



//Book page
Vue.component('books', books);
Vue.component('create-book-modal', createBooks);
Vue.component('edit-book-modal', editBooks);
Vue.component('delete-book-modal', deleteBooks);

//Authors page
Vue.component('authors', authors);
Vue.component('create-author-modal', createAuthors);
Vue.component('edit-author-modal', editAuthors);
Vue.component('delete-author-modal', deleteAuthors);

//Editorials page
Vue.component('editorials', editorials);
Vue.component('create-editorial-modal', createEditorials);
Vue.component('edit-editorial-modal', editEditorials);
Vue.component('delete-editorial-modal', deleteEditorials);

//Partners page
Vue.component('partners', partners);
Vue.component('create-partners-modal', createPartners);
Vue.component('edit-partners-modal', editPartners);
Vue.component('delete-partners-modal', deletePartners);

new Vue({
    el: '#app'
})