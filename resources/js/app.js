/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import globalHome from './components/globalHome.vue';
import navbar from './components/navbar.vue';
import sidebar from './components/sidebar.vue';
import router from './routes/routes.js';

app.component('global-home', globalHome);
app.component('navbar', navbar);
app.component('sidebar', sidebar);
app.use(router).mount('#app');
