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





key('a', function(){ alert('stopped reload!'); return false });

// 回调函数返回 false 以阻止浏览器默认事件行为
key('ctrl+r', function(){ alert('stopped reload!'); return false });

// 绑定多个快捷键，做同一件事
key('⌘+r, ctrl+r', function(){ alert('stopped reload!'); return false });


$("#ooo").on("show.bs.modal",function(e){
    console.log('顯示視窗前呼叫');
  });
  
  //轉場特效結束，已完全呈現時呼叫
  $("#ooo").on("shown.bs.modal",function(e){
    console.log('轉場特效結束，已完全呈現時呼叫');
  });
  
  //關閉視窗前呼叫
  $("#ooo").on("hide.bs.modal",function(e){
    console.log('關閉視窗前呼叫');
  });
  
  //轉場特效結束，已完全隱藏時呼叫
  $("#ooo").on("hidden.bs.modal",function(e){
    console.log('轉場特效結束，已完全隱藏時呼叫');
  });
  
  //隱藏視窗
  $("#ooo").modal('hide');
  
  //開啟視窗
  $("#ooo").modal('show');
  
  //切換視窗顯示、不顯示
  $("#ooo").modal('toggle');
  
  //判斷視窗是否開啟中
  if($("#ooo").hasClass('in')){
    console.log('視窗目前是開啟的狀態..');
  }

  //

  $("#XXX").on("show.bs.modal",function(e){
    console.log('顯示視窗前呼叫');
  });
  
  //轉場特效結束，已完全呈現時呼叫
  $("#XXX").on("shown.bs.modal",function(e){
    console.log('轉場特效結束，已完全呈現時呼叫');
  });
  
  //關閉視窗前呼叫
  $("#XXX").on("hide.bs.modal",function(e){
    console.log('關閉視窗前呼叫');
  });
  
  //轉場特效結束，已完全隱藏時呼叫
  $("#XXX").on("hidden.bs.modal",function(e){
    console.log('轉場特效結束，已完全隱藏時呼叫');
  });
  
  //隱藏視窗
  $("#XXX").modal('hide');
  
  //開啟視窗
  $("#XXX").modal('show');
  
  //切換視窗顯示、不顯示
  $("#XXX").modal('toggle');
  
  //判斷視窗是否開啟中
  if($("#XXX").hasClass('in')){
    console.log('視窗目前是開啟的狀態..');
  }