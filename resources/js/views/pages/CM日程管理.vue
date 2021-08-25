<template>
  <div id="MJ" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-sm" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"  @click.prevent="cleanData">
              <span>&times;</span>
            </button>
          </div>
		  <div class="modal-body" >
				預約丈量日 : &nbsp;&nbsp;
					<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].ReserveDate"
						:readonly="state == 1"
					/><br /><br />
				預約丈量時間 :
				<input
						type="time"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].Time"
						:readonly="state == 1"
					/><br /><br />
				丈量人員 :
				 <select v-model="Data[0].MeasureMember"> 
                    <option
                      v-for="item in UserData" :value="item.EMID" :key="item"
                    >
                        {{ item.EMID }}|{{ item.EMME }}
                    </option>
                  </select><br /><br /><br />
				  丈量準備方向與重點<br />
				  <textarea class="form-control" style="height:200px;display:inline" v-model="Data[0].Memo"></textarea><br />
				  </div>
				  <div style="text-align: center;height:50px;">
				  <button  @click.prevent="saveJ" data-dismiss="modal" style="display:inline;border: 1px black solid;" class="btn">確定</button>&nbsp;
				  <button data-dismiss="modal" style="display:inline;border: 1px black solid;"  class="btn"  @click.prevent="cleanData">取消</button>
          		</div>
        </div>
      </div>
    </div>

<div id="MJFinish" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" @click.prevent="cleanstate">
              <span>&times;</span>
            </button>
          </div>
		 		<div class="modal-body" >
				  丈量取消原因/丈量取得資訊<br />
				  <textarea class="form-control" style="height:200px;display:inline"  v-model="Data[0].result"></textarea><br /><br />
				  <input type="radio" name="MJstate" value=0 v-model="MJstate"/>丈量取消
				  <input type="radio" name="MJstate" value=1 v-model="MJstate"/>丈量完成
				  <input type="checkbox" name="endch" v-model="MeasureEarly"/>提前&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 	<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].ReserveDate"
						:hidden="MeasureEarly==false"
					/>
					<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].Time"
						:hidden="MeasureEarly==false"
					/>
				  	<br /><br />
				  <button  @click.prevent="saveJC" data-dismiss="modal" style="display:inline;border: 1px black solid;" class="btn" :hidden="nextJ==true">確定</button>&nbsp;
				  <button @click.prevent="cleanstate" data-dismiss="modal" style="display:inline;border: 1px black solid;"  class="btn" :hidden="nextJ==true">取消</button>
				  </div>
				

				 <div class="modal-body" >
				 <input type="checkbox" name="nextJ" v-model="nextJ"/>下次有預約談圖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div class="modal-body" :hidden="nextJ==false">
				  <ReservePicture @my-data="saveJC" @my-clean="cleanstate" v-bind:DataN="Data" v-bind:S=0 v-if="ref"></ReservePicture>
				  </div>
          </div>
	  </div>
    </div>

<div id="MJModify" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" @click.prevent="cleanData">
              <span>&times;</span>
            </button>
          </div>
		 		<div class="modal-body" >
					 <ModifyJ @my-refresh="cleanData" v-bind:Data="Data"></ModifyJ>
				  </div>

        </div>
      </div>
</div>

<div id="MK" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-sm" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"  @click.prevent="cleanData">
              <span>&times;</span>
            </button>
          </div>
		  <div class="modal-body" >
				預約看圖日 : &nbsp;&nbsp;
					<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].ReserveDate"
					/><br /><br />
				預約看圖時間 :
				<input
						type="time"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].Time"
					/><br /><br />
				丈量人員 :
				 <select v-model="Data[0].MeasureMember"> 
                    <option
                      v-for="item in UserData" :value="item.EMID" :key="item"
                    >
                        {{ item.EMID }}|{{ item.EMME }}
                    </option>
                  </select><br /><br />
				  預約成交日 :
				   <input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].EstimateDealDate"
					/><br /><br />
				 預約成交率 :
				   <input
						type="number"
						class="form-control"
						style="display: inline; width: 80px"
						v-model="Data[0].EstimateDealRate"
						min = 0
						:readonly="state == 1"
					/>%<br /><br />
				  看圖準備方向與重點<br />
				  <textarea class="form-control" style="height:200px;display:inline" v-model="Data[0].Memo"></textarea><br />
				  </div>
				  <div style="text-align: center;height:50px;">
				  <button  @click.prevent="saveK" data-dismiss="modal" style="display:inline;border: 1px black solid;" class="btn">確定</button>&nbsp;
				  <button @click.prevent="cleanData" data-dismiss="modal" style="display:inline;border: 1px black solid;"  class="btn">取消</button>
          		</div>
        </div>
      </div>
    </div>

<div id="MKFinish" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" @click.prevent="cleanstate">
              <span>&times;</span>
            </button>
          </div>
		 		<div class="modal-body" >
				  看圖取消原因/看圖取得資訊<br />
				  <textarea class="form-control" style="height:200px;display:inline"  v-model="Data[0].result"></textarea><br /><br />
				  <input type="radio" name="MKstate" value=0 v-model="MKstate"/>看圖取消
				  <input type="radio" name="MKstate" value=1 v-model="MKstate"/>看圖完成
					<br /><br />
				  <button  @click.prevent="saveKC" data-dismiss="modal" style="display:inline;border: 1px black solid;" class="btn" :hidden="nextK==true">確定</button>&nbsp;
				  <button @click.prevent="cleanstate" data-dismiss="modal" style="display:inline;border: 1px black solid;"  class="btn" :hidden="nextK==true">取消</button>
				  </div>

				 <div class="modal-body" >
				 <input type="checkbox" name="nextK" v-model="nextK"/>下次有預約談圖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 </div>
				<div class="modal-body" :hidden="nextK==false">
				 <ReservePicture @my-data="saveKC" @my-clean="cleanstate" v-bind:DataN="Data" v-bind:S=1 v-if="ref"></ReservePicture>
				</div>
        </div>
      </div>
    </div>

<div id="MKModify" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"  @click.prevent="cleanData">
              <span>&times;</span>
            </button>
          </div>
		 		<div class="modal-body" >
					 <ModifyK @my-refresh="cleanData" v-bind:Data="Data"></ModifyK>
				  </div>

        </div>
      </div>
</div>

<a style="position:relative;right:300px;">
  <div class="topic" style="text-align: center">
      <h1>日程管理</h1>
	   <button @click.prevent="backpage" type="submit">返回</button>
    </div>
    <br />
      <div class="row" style="height: 700px;width:1400px;">
        <div class="col-md-7 mb-4">
			<div class="container text-center" style="overflow-y:scroll;height:700px;width:800px;">   
			<table class="container" style="border: 1px  black solid;">
			<tr style="border: 1px black solid;">
				<th style="width:20%">次數/類別/狀態</th>
				<th style="width:40%;border: 1px black solid;">準備方向</th>
				<th style="width:40%">結果</th>
			</tr>
				<tr   v-for="(item,index) in DataJ" 
						:value="item"
						:key="index"
						style="border: 1px black solid;"
						>
					<td>
						<label v-show="item.狀態=='0'">第{{index+1}}次丈量未完成</label>
						<label v-show="item.狀態=='1'">第{{index+1}}次丈量取消</label>
						<label v-show ="item.狀態=='2'">第{{index+1}}次丈量完成</label>
						{{item.預定日期}}<br />{{item.時間}}<br />
						<button  @click.prevent="ModifyJ(index)" style="display:inline;border: 1px black solid;" class="btn">修改</button>&nbsp;
						<button  @click.prevent="DeleteJ(index)" style="display:inline;border: 1px black solid;" class="btn" v-show="item.狀態=='0'">刪除</button><br>
					</td>
					<td><textarea class="form-control" style="height:150px;width:300px;display:inline" v-model="item.Memo" readonly></textarea></td>
					<td><textarea class="form-control" style="height:150px;width:300px;display:inline" v-model="item.result" readonly></textarea></td>
				</tr> 
			<tr   v-for="(item,index) in DataK" 
						:value="item"
						:key="index"
						style="border: 1px black solid;"
						>
					<td>
						<label v-show="item.狀態=='3'">第{{index+1}}次看圖未完成</label>
						<label v-show="item.狀態=='4'">第{{index+1}}次看圖取消</label>
						<label v-show ="item.狀態=='5'">第{{index+1}}次看圖完成</label>
						{{item.預定日期}}<br />{{item.時間}}<br />
						<button  @click.prevent="ModifyK(index)" style="display:inline;border: 1px black solid;" class="btn">修改</button>&nbsp;
						<button  @click.prevent="DeleteK(index)" style="display:inline;border: 1px black solid;" class="btn" v-show="item.狀態=='3'">刪除</button><br>
					</td>
					<td><textarea class="form-control" style="height:150px;width:300px;display:inline" v-model="item.Memo" readonly></textarea></td>
					<td><textarea class="form-control" style="height:150px;width:300px;display:inline" v-model="item.result" readonly></textarea></td>
				</tr> 
			 </table>
		   </div>
		</div>
		<div class="col-md-4 mb-4">
			
            <h2>目前客戶狀態</h2>
            丈量統計<br />
            <button @click.prevent="addMeasureJ" type="submit" :hidden="Mstate == 1" style="height:30px;width:150px;" v-show="Jstate==0">新增丈量</button>
            <button @click.prevent="finishMeasureJ" type="submit" :hidden="Mstate == 0" style="height:30px;width:150px;" v-show="Jstate==1">最新丈量結案</button>
			<br /><br /><br />
			看圖統計<br />
            <button @click.prevent="addMeasureK" type="submit" :hidden="Pstate == 1" style="height:30px;width:150px;" v-show="Kstate==0">新增看圖</button>
            <button @click.prevent="finishMeasureK" type="submit" :hidden="Pstate == 0" style="height:30px;width:150px;" v-show="Kstate==1">最新看圖結案</button>
			<br /><br />
			結案內容<br />
			<textarea class="form-control" style="height:350px;width:300px;display:inline" v-model="CHKendData[0].memo"></textarea>
			<br />
			<input type="radio" name="endch" value=0 v-model="CHKendData[0].code_" :checked="CHKendData[0].code_== 0"/>轉購單品待追蹤
			<br />
			<input type="radio" name="endch" value=1 v-model="CHKendData[0].code_" :checked="CHKendData[0].code_== 1"/>已簽約或是無購買意願&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button @click.prevent="CancelEnd" type="Cancelendch" style="height:30px;width:80px;" :hidden="CHKendData[0].Type_ != 85">取消結案</button>
			<button @click.prevent="SendEnd" type="saveendch" style="height:30px;width:80px;" :hidden="CHKendData[0].Type_ == 85">結案報告</button>
        </div>
    </div>
</a>
</template>

<script>
	import ReservePicture from "../dropwindow/ReservePicture.vue";
	import ModifyJ from "../dropwindow/ModifyJ日程.vue";
	import ModifyK from "../dropwindow/ModifyK日程.vue";
  const axios = require("axios");
	export default {
		 props: ["Data","CNO","Dept"],
		 components: {
      ReservePicture,
	  ModifyJ,
	  ModifyK,
    },
  name: "CM日程管理",
  data() {
    return {
	 ref:false,
	 endch:"0",							//轉購單品待追蹤、已簽約或是無購買意願
	 DataJ:[],							//存取丈量之chk資料
	 DataK:[],							//存取看圖之chk資料
	 UserData:[],						//存取門市員工
	 Data:[								//存取要上傳chk資料
        {
          OrderNo: "",
          CustNo: this.CNO,
          ReserveDate: "",
          Time: "",
          FinishDate: "",
          MeasureMember: "",
          MeasureAddress: "",
          Memo: "",
		  Dept: this.Dept ,
          state: "",
          EstimateDealDate: "",
          EstimateDealRate: "",
		  result:"",						//丈量&看圖各自結案的MEMO
        },
      ],							
	Jstate:0,							//判斷新增丈量或是最新丈量結案
	Kstate:0,							//判斷新增看圖或是最新看圖結案
	MJstate:0,							//判斷丈量取消或是丈量完成
	MKstate:0,							//判斷看圖取消或是看圖完成

	MeasureEarly:false,					//提前之判定
	nextJ:false,						//有預約下次談圖判定
	nextK:false,						    //有預約下次談圖判定

	CHKendData:[{
		Type_:"",
		code_:"",
		memo:"",
	}],

	newData:[],
    };
  },
  methods: {
	backpage: function(){
		this.$emit('my-event');
	},
	refresh: function(){
			 axios
      .get("/api/search/chk/"+this.CNO)
      .then((response) => {
        console.log(response.data);
        this.DataJ = response.data[0];
		this.DataK = response.data[1];
		this.Jstate = response.data[2];
		this.Kstate = response.data[3];
      });
	  	axios
      .get("/api/search/CmMemo/"+this.CNO+"&&85")
      .then((response) => {
        console.log(response.data);
        this.CHKendData[0] = response.data;
      });
	  this.ref = true;
	},
	cleanData: function () {
		this.MeasureEarly=false,
		this.nextJ=false,						//有預約下次談圖判定
		this.nextK=false,	
		this.MJstate=0,							//判斷丈量取消或是丈量完成
		this.MKstate=0,
		this.Data=[							
        {
          OrderNo: "",
          CustNo: this.CNO,
          ReserveDate: "",
          Time: "",
          FinishDate: "",
          MeasureMember: "",
          MeasureAddress: "",
          Memo: "",
		  Dept:5000,
          state: "",
          EstimateDealDate: "",
          EstimateDealRate: "",
		   result:"",
        },
      ],
	  this.refresh();
	},
	cleanstate: function () {
		this.MeasureEarly=false,
		this.nextJ=false,						//有預約下次談圖判定
		this.nextK=false	
		this.refresh();
	},
	DeleteJ:function (index) {
		 axios
        .post("/api/Update/DeleteMeasureJK", {
          OrderNo: this.DataJ[index]['單號'],
		  type: "J",
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
		this.cleanData();
	},
	DeleteK:function (index) {
		 axios
        .post("/api/Update/DeleteMeasureJK", {
          OrderNo: this.DataK[index]['單號'],
		  type: "K",
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
		this.cleanData();
	},
	addMeasureJ: function () {
		$("#MJ").modal('toggle');
	},
	finishMeasureJ: function () {
		$("#MJFinish").modal('toggle');
		this.Data[0]['OrderNo'] = this.DataJ[this.DataJ.length-1]['單號'];
		this.Data[0]['CustNo'] = this.DataJ[this.DataJ.length-1]['客戶號'];
		this.Data[0]['ReserveDate'] = this.DataJ[this.DataJ.length-1]['預定日期'];
		this.Data[0]['Time'] = this.DataJ[this.DataJ.length-1]['時間'];
		this.Data[0]['FinishDate'] = this.DataJ[this.DataJ.length-1]['完工日期'];
		this.Data[0]['MeasureMember'] = this.DataJ[this.DataJ.length-1]['丈量人員'];
		this.Data[0]['MeasureAddress'] = this.DataJ[this.DataJ.length-1]['丈量地址'];
		this.Data[0]['Memo'] = this.DataJ[this.DataJ.length-1]['Memo'];
		this.Data[0]['Dept'] = this.DataJ[this.DataJ.length-1]['門市別_StoreNo'];
		this.Data[0]['state'] = this.DataJ[this.DataJ.length-1]['狀態'];
		this.Data[0]['EstimateDealDate'] = this.DataJ[this.DataJ.length-1]['預計成交日'];
		this.Data[0]['EstimateDealRate'] = this.DataJ[this.DataJ.length-1]['預計成交率'];
		this.Data[0]['result'] = this.DataJ[this.DataJ.length-1]['result'];
		this.ref=true;
	},
	ModifyJ: function (index) {
		$("#MJModify").modal('toggle');
		this.Data[0]['OrderNo'] = this.DataJ[index]['單號'];
		this.Data[0]['CustNo'] = this.DataJ[index]['客戶號'];
		this.Data[0]['ReserveDate'] = this.DataJ[index]['預定日期'];
		this.Data[0]['Time'] = this.DataJ[index]['時間'];
		this.Data[0]['FinishDate'] = this.DataJ[index]['完工日期'];
		this.Data[0]['MeasureMember'] = this.DataJ[index]['丈量人員'];
		this.Data[0]['MeasureAddress'] = this.DataJ[index]['丈量地址'];
		this.Data[0]['Memo'] = this.DataJ[index]['Memo'];
		this.Data[0]['Dept'] = this.DataJ[index]['門市別_StoreNo'];
		this.Data[0]['state'] = this.DataJ[index]['狀態'];
		this.Data[0]['EstimateDealDate'] = this.DataJ[index]['預計成交日'];
		this.Data[0]['EstimateDealRate'] = this.DataJ[index]['預計成交率'];
		this.Data[0]['result'] = this.DataJ[index]['result'];
	},
	finishMeasureK: function () {
		$("#MKFinish").modal('toggle');
		this.Data[0]['OrderNo'] = this.DataK[this.DataK.length-1]['單號'];
		this.Data[0]['CustNo'] = this.DataK[this.DataK.length-1]['客戶號'];
		this.Data[0]['ReserveDate'] = "";
		this.Data[0]['Time'] = "";
		this.Data[0]['FinishDate'] = this.DataK[this.DataK.length-1]['完工日期'];
		this.Data[0]['MeasureMember'] = this.DataK[this.DataK.length-1]['丈量人員'];
		this.Data[0]['MeasureAddress'] = this.DataK[this.DataK.length-1]['丈量地址'];
		this.Data[0]['Memo'] = this.DataK[this.DataK.length-1]['Memo'];
		this.Data[0]['Dept'] = this.DataK[this.DataK.length-1]['門市別_StoreNo'];
		this.Data[0]['state'] = this.DataK[this.DataK.length-1]['狀態'];
		this.Data[0]['EstimateDealDate'] = "";
		this.Data[0]['EstimateDealRate'] = "";
		this.Data[0]['result'] = this.DataK[this.DataK.length-1]['result'];
		this.ref=true;
	},
	addMeasureK: function () {
		$("#MK").modal('toggle');
	},
	ModifyK: function (index) {
		$("#MKModify").modal('toggle');
		this.Data[0]['OrderNo'] = this.DataK[index]['單號'];
		this.Data[0]['CustNo'] = this.DataK[index]['客戶號'];
		this.Data[0]['ReserveDate'] = this.DataK[index]['預定日期'];
		this.Data[0]['Time'] = this.DataK[index]['時間'];
		this.Data[0]['FinishDate'] = this.DataK[index]['完工日期'];
		this.Data[0]['MeasureMember'] = this.DataK[index]['丈量人員'];
		this.Data[0]['MeasureAddress'] = this.DataK[index]['丈量地址'];
		this.Data[0]['Memo'] = this.DataK[index]['Memo'];
		this.Data[0]['Dept'] = this.DataK[index]['門市別_StoreNo'];
		this.Data[0]['state'] = this.DataK[index]['狀態']-3;
		this.Data[0]['EstimateDealDate'] = this.DataK[index]['預計成交日'];
		this.Data[0]['EstimateDealRate'] = this.DataK[index]['預計成交率'];
		this.Data[0]['result'] = this.DataK[index]['result'];
	},
	saveJ: function () {
		 axios
        .post("/api/Create/Measure", {
          Data: this.Data,
          type: "J",
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
		this.cleanData();
	},
	saveK: function () {
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
		
		this.refresh();
		this.cleanData();
	},
	saveJC: function () {
		 axios
        .post("/api/Update/Measurestate", {
          Data: this.Data,
		  type: "J",
		  state: this.MJstate,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
		this.cleanData();
		
	},
	saveKC: function () {
	 axios
        .post("/api/Update/Measurestate", {
         Data: this.Data,
		  type: "K",
		  state: this.MKstate,	
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.ref=false;
		this.refresh();
		this.cleanData();
	},
	CancelEnd: function () {
	 axios
        .post("/api/Update/MeasureEnd", {
		CustNo: this.Data[0].CustNo,
        Data: this.CHKendData,
		  type: 101,	
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
	},
	SendEnd: function () {
	 axios
        .post("/api/Create/MeasureEnd", {
         Data: this.CHKendData,
		 CustNo: this.Data[0].CustNo,
		  type: 85,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
		this.refresh();
	},
},     
  mounted(){
      axios
      .get("/api/search/chk/"+this.CNO)
      .then((response) => {
        console.log(response.data);
        this.DataJ = response.data[0];
		this.DataK = response.data[1];
		this.Jstate = response.data[2];
		this.Kstate = response.data[3];
      });
		 axios
		.get("/api/search/UserDept/"+this.Data[0].Dept)
		.then((response) => {
			console.log(response.data);
			this.UserData = response.data;
		});
	axios
      .get("/api/search/CmMemo/"+this.CNO+"&&85")
      .then((response) => {
        console.log(response.data);
        this.CHKendData[0] = response.data;
      });
    }
};
</script>
