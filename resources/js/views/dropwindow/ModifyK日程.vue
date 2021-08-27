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
     :readonly="Data[0].state==0"
  ></textarea
  ><br /><br />
   <input type="radio" name="stateK" value=1 v-model="Data[0].state" :checked="Data[0].state==1"/>談圖取消
   &nbsp;&nbsp;&nbsp;
	<input type="radio" name="stateK" value=2 v-model="Data[0].state" :checked="Data[0].state==2"/>談圖完成
 &nbsp;&nbsp;&nbsp;
  <input type="radio" name="stateK" value=0 v-model="Data[0].state" v-show="Data[0].state==0" checked/><a v-show="Data[0].state==0">尚未商談</a>
   <br /><br />
  預計成交日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
     v-model="Data[0].EstimateDealDate"
     :min="newdate"
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
      @click.prevent="cleanData"
    >
      取消
    </button>
  </div>
</template>
<script>
const axios = require("axios");
export default {
  props: ["Data"],
  name: "ModifyK日程",
  data: function () {
    return {
      newdate:new Date(Date.now()).toISOString().slice(0,10),
     Data:this.Data,
    };
  },
  methods:{
    cleanData: function () {
       this.$emit('my-refresh');
	  },
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
        this.$emit('my-refresh');
	},
  }
};
</script>