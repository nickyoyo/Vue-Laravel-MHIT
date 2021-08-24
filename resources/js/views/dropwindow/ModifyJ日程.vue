<template>
  準備方向與重點 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
    v-model="Data[0].Memo"
  ></textarea
  >
  獲得資訊或取消原因 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
      v-model="Data[0].result"
    :readonly="Data[0].state==0"
  ></textarea
  ><br />
   <input type="radio" name="stateJ" value=1 v-model="Data[0].state" :checked="Data[0].state==1"/>丈量取消
   &nbsp;&nbsp;&nbsp;
	<input type="radio" name="stateJ" value=2 v-model="Data[0].state" :checked="Data[0].state==2"/>丈量完成
   &nbsp;&nbsp;&nbsp;
	<input type="radio" name="stateJ" value=0 v-model="Data[0].state" :checked="Data[0].state==0" :v-show="Data[0].state==0"/>尚未丈量
   <br />
  <div style="text-align: center; height: 50px">
    <button
      @click.prevent="save"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
    >確定</button
    >&nbsp;
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
  name: "ModifyJ日程",
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
          type: "J",
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
	},
  },
  
};
</script>