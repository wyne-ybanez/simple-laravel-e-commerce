import { createApp } from 'vue'
import store from './store/'
import router from './router/'
import "./input.css";

import App from './App.vue'

const app = createApp(App);

app
.use(store)
.use(router)
.mount("#app")
;

createApp(App)
    .use(store)
    .use(router)
    .mount('#app')
