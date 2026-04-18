import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Login.vue';

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});