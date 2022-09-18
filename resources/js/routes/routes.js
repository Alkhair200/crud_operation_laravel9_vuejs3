import { createWebHistory, createRouter } from "vue-router";
import Welcome from "../components/welcome.vue";
import Login from "../components/auth/login.vue";
import Register from "../components/auth/register.vue";
import Post from "../components/post.vue";

const routes = [
    {
        path:'/',
        name:'welcome',
        component:Welcome
    },{
    path: '/login',
    name: 'login',
    component: Login
}, {
    path: '/register',
    name: 'register',
    component: Register
}, 

{
    path: '/posts',
    name: 'posts',
    component: Post
},
];

const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;