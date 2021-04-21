import Vue from 'vue'

//Main pages
import router from './router';
import App from './App';


const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});

