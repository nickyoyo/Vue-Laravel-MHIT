<template>
  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <h1>查詢客戶資料</h1>
    <label for="PID">客戶編號:</label><br />
    <input type="text" v-model="PID" id="PID" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /><br /><br />
    <button @click.prevent="searchCM" type="submit" >查詢資料</button>&nbsp;
    <button> <router-link to="/CM/接待自評" style="color:black;">新增客戶資料</router-link></button>
    <br />
    <br />
    <input type="button" onclick="history.back()" value="Back" />&nbsp;
    <a href="/" class="back" style="color: black; font-size: 10px">回首頁</a>
  </div>
</template>

<script>
  const axios = require("axios");
export default {
  name: "CMsendSearch",
  data() {
    return {
      PID: [],
      EMID:[],
    };
  },
  methods: {
    searchCM: function () {
       const CNO = this.PID
        const state = 1
      this.$router.push({ name: "CMpage", params: { CNO,state } });
    },
     modifyCM: function () {
       const CNO = this.PID
        const state = 2
      this.$router.push({ name: "CMpage", params: { CNO,state } });
    },
  },
};
</script>
