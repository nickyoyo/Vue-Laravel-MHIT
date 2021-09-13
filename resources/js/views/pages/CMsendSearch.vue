<template>
  <div id="CMList" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <CMList @getCustNo="setCustNo"></CMList>
  </div>

  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <h1>查詢客戶資料</h1>
    <label for="PID">客戶編號:</label><br />
    <input type="text" v-model="PID" id="PID" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
    <label :hidden="msg==''" style="color:red">此客編不存在</label><br /><br />
    <button @click.prevent="searchCM" type="submit" >查詢資料</button>&nbsp;
    <button> <router-link to="/CM/接待自評" style="color:black;">新增客戶資料</router-link></button>
    <br />
    <br />
    <input type="button" onclick="history.back()" value="Back" />&nbsp;
    <a href="/" class="back" style="color: black; font-size: 10px">回首頁</a>
  </div>
</template>

<script>
import CMList from "../dropwindow/CMList.vue";
  const axios = require("axios");
export default {
  name: "CMsendSearch",
   components: {
      CMList,
    },
  data() {
    return {
      PID: [],
      msg: "",
    };
  },
  methods: {
    searchCM: function () {   
         axios
        .get("/api/search/CM/" + this.PID)
        .then((response) => {
          console.log(response.data.msg);        
            this.msg = response.data.msg;
              if(this.msg==''){
                const CNO = this.PID;
                const state = 1;
                this.$router.push({ name: "CMpage", params: { CNO,state } });
            }
          });
    
    },
    setCustNo: function(CustNo){
        this.PID = CustNo;
        $("#CMList").modal('hide');   
      },
     modifyCM: function () {
       const CNO = this.PID
        const state = 2
      this.$router.push({ name: "CMpage", params: { CNO,state } });
    },
  },
  mounted() {
        document.getElementById('PID').addEventListener('keydown',function(e){
            if (e.shiftKey) {
                  $("#CMList").modal('show');              
            }
                },false);
        },
};

</script>
