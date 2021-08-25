<template>
  下次談圖日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="Data[0].ReserveDate"
  />
  &nbsp;&nbsp;
  <input
    type="time"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="Data[0].Time"
  /><br /><br />
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
	min = 0
    v-model="Data[0].EstimateDealRate"
  /><br /><br />
  下次談圖準備方向 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
    v-model="Data[0].Memo"
  ></textarea
  ><br />
  <div style="text-align: center; height: 50px">
    <button
      @click.prevent="save"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
	  :hidden="S==1"
    >確定</button
    >&nbsp;
	<button
      @click.prevent="saveK"
      data-dismiss="modal"
      style="display: inline; border: 1px black solid"
      class="btn"
	  :hidden="S==0"
    >
      確定</button
    >&nbsp;
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
  props: ["DataN","S"],
  name: "ReservePicture",
  data: function () {
    return {
      DataA:this.DataN,
      Data:[								//存取要上傳chk資料
        {
          OrderNo: "",
          CustNo: this.DataN[0].CustNo,
          ReserveDate: "",
          Time: "",
          FinishDate: "",
          MeasureMember: "",
          MeasureAddress: "",
          Memo: "",
		      Dept: this.DataN[0].Dept,
          state: "",
          EstimateDealDate: "",
          EstimateDealRate: "",
		      result:"",
        },
      ],
      
    };
  },
  methods:{
    cleanData: function () {
      this.$emit('my-clean');
	},
	  save: function () {
      this.Data[0].MeasureMember = this.DataA[0].MeasureMember;
		 axios
        .post("/api/Create/Measure", {
          Data: this.Data,
          type: "K",
		  S: 0,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.$emit('my-data');
	},
	 saveK: function () {
		 axios
        .post("/api/Create/Measure", {
          Data: this.Data,
          type: "K",
		  S: 1,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.$emit('my-data');
	},
  },
  mounted(){
    this.Data[0].EstimateDealDate="";
    this.Data[0].EstimateDealRate="";
    this.Data[0].Memo="";
  },
};
</script>