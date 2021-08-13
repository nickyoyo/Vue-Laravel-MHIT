<template>
<div id="ooo" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        內容
      </div>
      <div class="modal-footer" >
        <button  @click.prevent="send" class="btn">OK</button>
        <button  @click.prevent="close" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- 使用按鈕開啟  data-target-->
<button @click.prevent="close" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ooo">YO</button>
</template>

<script>
  const axios = require("axios");
export default {
  name: "Login",
  data() {
    return {
      PID: [],
      EMID:[],
    };
  },
  methods: {
	opendata: function(){
		axios
      .get("http://127.0.0.1:8000/api/search/PD/"+ 21072177)
      .then((response) => {
        console.log(response.data.EM13);
        this.pd = response.data.EM13;
      });
  },
    send: function () {
       const CNO = this.PID
        const state = 1
      this.$router.push({ name: "CMpage", params: { CNO,state } });
    },
     close: function () {
       const CNO = this.PID
        const state = 2
      this.$router.push({ name: "CMpage", params: { CNO,state } });
    },
  },
};
</script>
