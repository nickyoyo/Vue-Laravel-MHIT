//-------------- IMPORT ALL LIBRARY MODULES ------------------//
import { createApp } from 'vue';
import {createRouter, createWebHistory} from 'vue-router'
import store from './store';
//--------------- END ALL LIBRARY MODULES ------------------//

// Routes
import routes from './routes'

// Main App Component
import App from './views/layouts/App'

window.axios = require('axios');
//import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

// Router instance
const router = createRouter({
    history: createWebHistory(),
    routes,
})

// Init App
const app = createApp(App)

// Init router into app
app.use(router)
app.use(store)


// Mount the App
app.mount('#app')

// Done.....!

