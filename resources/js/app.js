import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import { authStore } from './store/auth';
import App from "./App.vue";
import router from "./router/app";

const app = createApp(App)

app.use(router);

app.mount("#app");

authStore.checkAuth();
