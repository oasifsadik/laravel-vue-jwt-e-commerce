import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Login.vue';
import Home from '../components/Home.vue';

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});