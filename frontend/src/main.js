import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faUser, faCoffee, faEnvelope, faMagnifyingGlass  } from '@fortawesome/free-solid-svg-icons'; // Adicione os ícones que você quer usar
import { faGoogle } from '@fortawesome/free-brands-svg-icons';

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

library.add(faUser, faCoffee, faGoogle, faEnvelope, faMagnifyingGlass ); // Adicione os ícones à biblioteca

const app = createApp(App)

app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router)
app.use(store)

app.mount('#app')
