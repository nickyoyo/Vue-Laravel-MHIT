<template>
  準備方向與重點 :<br />
  <textarea
    class="form-control"
    style="height: 100px; display: inline"
     v-model="Data[0].Memo"
  ></textarea
  ><br /><br />
  獲得資訊或取消原因 :<br />
  <textarea
    class="form-control"
    style="height: 100px; display: inline"
    v-model="Data[0].result"
  ></textarea
  ><br /><br />
   <input type="radio" name="state" value=0 v-model="Data[0].state" :checked="Data[0].state==0"/>談圖取消
   &nbsp;&nbsp;&nbsp;
	<input type="radio" name="state" value=1 v-model="Data[0].state" :checked="Data[0].state==1"/>談圖完成
   <br /><br />
  預計成交日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
     v-model="Data[0].EstimateDealDate"
  />
  &nbsp;&nbsp; 預計成交率 : &nbsp;&nbsp;
  <input
    type="number"
    class="form-control"
    style="display: inline; width: 80px"
    v-model="Data[0].EstimateDealRate"
	min = 0
  /><br /><br />
  <div style="text-align: center; height: 50px">
    <button
      @click.prevent="save"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
    >確定
    </button>
    &nbsp;
    <button
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
    >
      取消
    </button>
  </div>
</template>
<script>
const axios = require("axios");
export default {
  props: ["DataN"],
  name: "ModifyK日程",
  data: function () {
    return {
     Data:this.DataN,
    };
  },
  methods:{
     save: function () {
		 axios
        .post("/api/Update/Measurestate", {
          Data: this.Data,
          state:this.Data[0].state,
          type: "K",
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
	},
  }
};
</script>