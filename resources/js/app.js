import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
const app = createApp(App);
app.config.globalProperties.$asset = (path) => {
    return window.Laravel?.baseUrl 
        ? `${window.Laravel.baseUrl}/${path}` 
        : `/${path}`
}
app.use(router).mount('#app');