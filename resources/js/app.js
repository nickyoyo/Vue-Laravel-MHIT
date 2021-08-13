//-------------- IMPORT ALL LIBRARY MODULES ------------------//
import { createApp } from 'vue';
import {createRouter, createWebHistory} from 'vue-router'
import store from './store';
import key from 'keymaster'
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


key('a', function(){ alert('you pressed a!') });

// 回调函数返回 false 以阻止浏览器默认事件行为
key('ctrl+r', function(){ alert('stopped reload!'); return false });

// 绑定多个快捷键，做同一件事
key('⌘+r, ctrl+r', function(){ });