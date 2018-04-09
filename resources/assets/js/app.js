
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// Require Froala Editor js file.
require('froala-editor/js/froala_editor.pkgd.min');

// Require Froala Editor css files.
require('froala-editor/css/froala_editor.pkgd.min.css');
require('font-awesome/css/font-awesome.css');
require('froala-editor/css/froala_style.min.css');

window.Vue = require('vue');

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)

import VueRouter from 'vue-router';
window.Vue.use(VueRouter);

import BooksIndex from './components/books/BooksIndex.vue';
import BooksCreate from './components/books/BooksCreate.vue';
import BooksEdit from './components/books/BooksEdit.vue';
import ChapterIndex from './components/chapters/ChaptersIndex.vue';
import ChapterCreate from './components/chapters/ChapterCreate.vue';
import ChapterEdit from './components/chapters/ChapterEdit.vue';
import PurchaseChapters from './components/purchaseChapters/PurchaseChapters.vue';
import PurchaseChapterDetail from './components/purchaseChapters/PurchaseChapterDetail.vue';

const routes = [
	    {
	        path: '/',
	        components: {
	            booksIndex: BooksIndex,
	            purchaseChapters: PurchaseChapters
	        }
	    },
	{ path: '/admin/books/create', component: BooksCreate, name: 'createBook' },
	{ path: '/admin/books/edit/:id', component: BooksEdit, name: 'editBook' },
    { path: '/admin/books/:id', component: ChapterIndex, name: 'chapter' },
    { path: '/admin/books/:id/chapter/create', component: ChapterCreate, name: 'addChapter' },
    { path: '/admin/books/:bookId/chapter/:chapterId', component: ChapterEdit, name: 'editChapter' },
 	{ path: '/admin/purchase-chapters', component: PurchaseChapters, name: 'purchaseChapters' },
 	{ path: '/admin/purchase-chapters/:id', component: PurchaseChapterDetail, name: 'purchaseChapterDetail'},
    

//    {path: '/admin/books', component: BooksIndex, name: 'booksIndex'},
    
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')