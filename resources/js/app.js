import './bootstrap';

import { createApp } from "vue";

import App from './layouts/app.vue';
import router from './router';
import axios from 'axios'
import Multiselect from '@vueform/multiselect';

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(Multiselect);
app.mount("#app");

document.title = 'Emulate'
