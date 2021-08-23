<template>
  準備方向與重點 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
  ></textarea
  >
  獲得資訊或取消原因 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
  ></textarea
  ><br />
   <input type="radio" name="state" value=0 v-model="state"/>談圖取消
   &nbsp;&nbsp;&nbsp;
	 <input type="radio" name="state" value=1 v-model="state"/>談圖完成
   <br />
  預計成交日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
  />
  &nbsp;&nbsp; 預計成交率 : &nbsp;&nbsp;
  <input
    type="number"
    class="form-control"
    style="display: inline; width: 80px"
	min = 0
  /><br /><br />
  <div style="text-align: center; height: 50px">
    <button
      @click.prevent="save"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
    >確定</button
    >&nbsp;
	<button
      @click.prevent="saveK"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
    >
      確定</button
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
  props: [],
  name: "ModifyJ日程",
  data: function () {
    return {
      Data: [
        //存取要上傳chk資料
        {
          OrderNo: "",
          CustNo: this.DataN[0].CustNo,
          ReserveDate: "",
          Time: "",
          FinishDate: "",
          MeasureMember: this.DataN[0].MeasureMember,
          MeasureAddress: this.DataN[0].MeasureAddress,
          Memo: "",
          Dept: this.DataN[0].Dept,
          state: "",
          EstimateDealDate: "",
          EstimateDealRate: "",
        },
      ],
    };
  },
  methods:{
  }
};
</script>