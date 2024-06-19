require('./bootstrap');
import {createApp} from 'vue'
import { createWebHistory, createRouter } from "vue-router";
import Auth from './Middleware/Auth.js'
import 'vue3-toastify/dist/index.css';
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

import mitt from 'mitt';
const emitter = mitt();

import routes from './routes';
import FormValidation from './Classes/FormValidation.js';
import Formater from './Classes/Formater.js';
import Toast from './Classes/Toast.js';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

let token = localStorage.getItem('token');
if(token){
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

const router = createRouter({
    history: createWebHistory(),
    routes
})

//Vue
const app = createApp({});

const files = require.context('./Components', true, /\.vue$/i)
files.keys().map(key => app.component(key.split('/').pop().split('.')[0], files(key).default))

app.use(Vue3Toasity, {autoClose: 3000})
app.use(router);
app.mount('#app');
app.use(VueSweetalert2);

app.config.globalProperties.$eventBus = emitter;
app.config.globalProperties.$auth = new Auth();
app.config.globalProperties.$toasty = new Toast();
app.config.globalProperties.$formValidation = new FormValidation();
app.config.globalProperties.$formater = new Formater();

