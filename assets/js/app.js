
const { createApp } = Vue;
const VueSweetalert2 = Swal;

import store from './components/blog/utils/store.js';
import utils from './components/blog/utils/utils.js';

import loader from './components/blog/utils/loader.js';
// import blogHome from './components/blog/Home.vue';
// import formLogin from './components/blog/Login.vue';
// import pageNoticia from './components/blog/Noticia.vue';

// const emitter = mitt();

const app = createApp(Home, {
    components: {
        blogHome,
        formLogin,
        pageNoticia
    }
});

app.config.globalProperties.emitter = emitter;

app.use(VueSweetalert2);
app.use(store);
app.use(loader);
app.use(utils);

app.mount('#app');