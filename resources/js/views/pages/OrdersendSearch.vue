<template>
  <div id="CMList" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">

     <CMList @getCustNo="setCustNo"></CMList>
  </div>

 

  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <h1>查詢門市訂單</h1>
    <label for="PID">客戶編號:</label><br />
    <input type="text" v-model="PID" id="PID" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
    <label :hidden="msg==''" style="color:red">此客編不存在</label><br /><br />
    <button @click.prevent="searchOrder" type="submit" >查詢資料</button>&nbsp;
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
      EMID:[],
      msg: "",
    };
  },
  methods: {
    searchOrder: function () {   
         axios
        .get("/api/search/Order/" + this.PID)
        .then((response) => {
          console.log(response.data.msg);        
            this.msg = response.data.msg;
              if(this.msg==''){
                const CNO = this.PID;
                this.$router.push({ name: "Orderpage", params: { CNO } });
            }
          });
    },
      setCustNo: function(CustNo){
        this.PID = CustNo;
        $("#CMList").modal('hide');   
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
