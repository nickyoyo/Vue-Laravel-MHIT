<template>
  下次談圖日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="DataN[0].ReserveDate"
  />
  &nbsp;&nbsp;
  <input
    type="time"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="DataN[0].Time"
  /><br /><br />
  預計成交日 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="DataN[0].EstimateDealDate"
  />
  &nbsp;&nbsp; 預計成交率 : &nbsp;&nbsp;
  <input
    type="date"
    class="form-control"
    style="display: inline; width: 180px"
    v-model="DataN[0].EstimateDealDate"
  /><br /><br />
  下次談圖準備方向 :<br />
  <textarea
    class="form-control"
    style="height: 200px; display: inline"
    v-model="DataN[0].Memo"
  ></textarea
  ><br />
  <div style="text-align: center; height: 50px">
    <button
      @click.prevent="save"
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
      @click.prevent="cleanDate"
    >
      取消
    </button>
  </div>
</template>
<script>
export default {
  props: ["Data"],
  name: "ReservePicture",
  data: function () {
    return {
      DataN: [
        //存取要上傳chk資料
        {
          OrderNo: "",
          CustNo: this.Data[0].CustNo,
          ReserveDate: "",
          Time: "",
          FinishDate: "",
          MeasureMember: "",
          MeasureAddress: "",
          Memo: "",
          Dept: this.Data[0].Dept,
          state: "",
          EstimateDealDate: "",
          EstimateDealRate: "",
        },
      ],
    };
  },
  methods:{
	  save: function () {
		 axios
        .post("/api/Create/CreateMeasure", {
          Data: this.DataN,
          type: "K",
		  state: 0,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.$emit('my-data');
	},
  }
};
</script>