<template>
    <!-- 跳出選住址-->
    <div id="ooo" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
            <div class="modal-body" >
            街路: <input
                    type="text"
                    class="form-control"
                    style="width: 200px;display:inline"
                    v-model="street[0].value"
                /><button  @click.prevent="getaddress" style="display:inline" class="btn">查詢</button><br>
                  <select v-model="addresschoose" :hidden="stateA==1"> 
                    <option
                      v-for="item in data" :value="item" :key="item"
                    >
                        {{ item.縣市 }}-{{ item.區鄉鎮市 }}-{{ item.街路}}
                    </option>
                  </select>
            <button  @click.prevent="sendaddress" class="btn" data-dismiss="modal" :hidden="stateA==1">送出</button>
          </div>
          </div>
        </div>
      </div>
    </div>

  <div style="  position:absolute;
                left:300px;
                height: 800px;
                width:1100px;
                margin: 0px auto;">
    <div class="topic">
      <h1>填寫客戶基本資料</h1>
    </div>
    <form action="submit.html" v-on:submit.prevent="postdata">
      <div class="row" style="height: 750px">
        <div class="col-md-5 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >基本資料</label
            >
          </h2>
           <br />
          <h4><label class="font-weight-bold">客戶名稱</label></h4>
         
          <table>
            <th style="width: 80%">
              <input
                type="text"
                class="form-control"
                v-model="cust[0].CustName"
                required
                style="width:300px"
              />
            </th>
            <th style="padding: 5px">
              <select
                style="height: 30px"
                id="Gender"
                name="Gender"
                v-model="cust[0].Gender"
              >
                <option
                  v-for="item in Gender"
                  :value="item.value"
                  :key="item.value"
                >
                  {{ item.data }}
                </option>
              </select>
            </th>
          </table>
          <br />
          <h4><label class="font-weight-bold">公司名稱</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="cust[0].COMPANY"
            style="width:300px"
          /><br />
          <h4><label class="font-weight-bold">E-Mail</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="cust[0].email"
            style="width:300px"
          /><br />
          <h4><label class="font-weight-bold"  style="display:inline">通訊地址</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="CusAddressC"
            style="display:inline;width:130px"
            readonly
          /><input
            type="text"
            class="form-control"
            v-model="CusAddressS"
             style="display:inline;width:270px"
          />
          <button @click.prevent="getcusaddress" type="button" class="btn btn-primary"  style="display:inline" data-toggle="modal" data-target="#ooo">S</button>
          <br />
          <h4><label class="font-weight-bold">安裝地址</label></h4>
           <input
            type="text"
            class="form-control"
            v-model="FittingAddC"
            style="display:inline;width:130px"
            readonly
          />
          <input
            type="text"
            class="form-control"
            style="display:inline;width:270px"
            v-model="FittingAddS"
          />
         <button @click.prevent="getfitaddress" type="button" class="btn btn-primary"  style="display:inline" data-toggle="modal" data-target="#ooo">S</button>
          <br />
          <h4><label class="font-weight-bold">建案名稱</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="cust[0].BuildName"
            style="width:300px"
          /><br />
        </div>
        <div class="col-md-3 mb-4" style="top: 50px;">
          <br />
         <input type="checkbox" v-model="CNO" checked  />自動填入員工編號
         <br />
          <h4>
            <label class="font-weight-bold"
              >身分證(統編)
              <input
                type="text"
                class="form-control"
                style="width: 200"
                v-model="cust[0].identification"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >負&nbsp;&nbsp;責&nbsp;&nbsp;人
              <input
                type="text"
                class="form-control"
                style="width: 200"
                v-model="cust[0].principal"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >電話(日)
              <input
                type="text"
                class="form-control"
                style="width: 200"
                v-model="cust[0].TelDay"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >聯絡電話
              <input
                type="text"
                class="form-control"
                style="width: 200"
                v-model="cust[0].Mobil"
                required
            /></label>
          </h4>
          <br />
        </div>
        <div class="col-md-3 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >來源與經驗</label
            >
          </h2> <br />
          <h4>
            <label class="font-weight-bold"
              >客戶來源:
              <select v-model="cust[0].CustType">
                <option
                  v-for="item in CustType"
                  :value="item.codeindex"
                  :key="item.codeindex"
                >
                  {{ item.codeDesc }}
                </option>
              </select></label
            >
          </h4>
          <div style="padding: 20px">
          <div class="row AF11tableborder-250wid">
            <div class="col-12">
              <h4><label class="font-weight-bold">使用經驗</label></h4>
            </div>
            <div
              class="col-6"
              v-for="item in UseExp"
              :value="item"
              :key="item"
              style="height: 25px"
            >
                <input type="checkbox" v-model="item.value"  :checked="item.value==1"/>{{item.data}}
            </div>
          </div>

            <br />
              <div class="row AF11tableborder-250wid">
              <div class="col-12">
                <h4><label class="font-weight-bold">同業了解</label></h4>
              </div>
              <div
                class="col-6"
                v-for="item in UDS"
                :value="item"
                :key="item"
                style="height: 25px"
              >
              <input type="checkbox" v-model="item.value"  :checked="item.value==1"/>{{item.data}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="height: 750px">
        <div class="col-md-4 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >訪談條件</label
            >
          </h2>
          <br />
          <h4>
            <label class="font-weight-bold"
              >屋況條件:
              <select v-model="cust[0].BuyReason">
                <option
                  v-for="item in BuyReason"
                  :value="item.codeindex"
                  :key="item.codeindex"
                >
                  {{ item.codeDesc }}
                </option>
              </select></label
            >
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >坪數<br />
              <input
                type="number"
                class="form-control"
                style="width: 50px"
                v-model="cust[0].TelNight"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >屋齡<br />
              <input
                type="number"
                class="form-control"
                style="width: 100px"
                v-model="cust[0].Birthday"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >交屋日期<br />
              <input
                type="date"
                class="form-control"
                style="width: 200px"
                v-model="cust[0].HouseDate"
                :min="newdate"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >家庭人數<br />
              <input
                type="number"
                class="form-control"
                style="width: 70px"
                v-model="cust[0].MemberCount"
                min="1"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >成員組合:
              <select v-model="cust[0].Family">
                <option
                  v-for="item in Family"
                  :value="item.codeindex"
                  :key="item.codeindex"
                >
                  {{ item.codeDesc }}
                </option>
              </select></label
            >
          </h4>
          <br />
        </div>
        <div class="col-md-3 mb-4" style="top: 50px">
          <br />
             <input type="checkbox" v-model="cust[0].needChk" checked  />有丈量需求
         <br /><br />
          <h4>
            <label class="font-weight-bold"
              >預計完工日<br />
              <input
                type="date"
                class="form-control"
                style="width: 200px"
                v-model="cust[0].FinishDate"
                :min="newdate"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >入厝時間<br />
              <input
                type="date"
                class="form-control"
                style="width: 200px"
                v-model="cust[0].CheckInDate"
                :min="newdate"
                required
            /></label>
          </h4>
          <br />
          <div class="row AF11tableborder-250wid">
          <div class="col-12">
            <h4><label class="font-weight-bold">喜好風格</label></h4>
          </div>
          <div
            class="col-4"
            v-for="item in likeStyle"
            :value="item"
            :key="item"
            style="height: 25px"
          >
          <input type="checkbox" v-model="item.value"  :checked="item.value==1"/>{{item.data}}
          </div>
        </div>
          <br />

          <h4>
            <label class="font-weight-bold"
              >屋型
              <select v-model="cust[0].HouseType">
                <option
                  v-for="item in HouseType"
                  :value="item.codeindex"
                  :key="item.codeindex"
                >
                  {{ item.codeDesc }}
                </option>
              </select></label
            >
          </h4>

          <br />
       <div class="row AF11tableborder-250wid">
          <div class="col-12">
            <h4><label class="font-weight-bold">規劃空間</label></h4>
          </div>

          <div
            class="col-4"
            v-for="item in space"
            :value="item"
            :key="item"
            style="height: 25px"
          >
            <input type="checkbox" v-model="item.value"  :checked="item.value==1"/>{{item.data}}
          </div>
        </div>
      </div>
    </div>
      <div class="row" style="height: 500px">
        <div class="col-md-3 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151">預算</label>
          </h2>
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;&nbsp;&nbsp;&nbsp;修預算<br />
              <input
                type="text"
                class="form-control"
                style="width: 165px"
                v-model="cust[0].budgetTot"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >木地板預算<br />
              <input
                type="text"
                class="form-control"
                style="width: 165px"
                v-model="cust[0].budgetFloor"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >系統櫃預算<br />
              <input
                type="text"
                class="form-control"
                style="width: 165px"
                v-model="cust[0].budgetCabinet"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >沙&nbsp;&nbsp;&nbsp;&nbsp;發預算<br />
              <input
                type="text"
                class="form-control"
                style="width: 165px"
                v-model="cust[0].budgetSofa"
                required
            /></label>
          </h4>
          <br />
        </div>

        <div class="col-md-3 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >合約相關</label
            >
          </h2>
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;&nbsp;修&nbsp;&nbsp;合&nbsp;&nbsp;約&nbsp;&nbsp;金額<br />
              <input
                type="text"
                class="form-control"
                v-model="cust[0].Budget"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;&nbsp;修&nbsp;&nbsp;未&nbsp;&nbsp;稅&nbsp;&nbsp;成本<br />
              <input
                type="text"
                class="form-control"
                v-model="cust[0].LastUse"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >拆&nbsp;&nbsp;除&nbsp;&nbsp;運&nbsp;&nbsp;送&nbsp;&nbsp;金額<br />
              <input
                type="text"
                class="form-control"
                v-model="cust[0].dismantle"
                required
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >系統家具合約金額<br />
              <input
                type="text"
                class="form-control"
                v-model="cust[0].HouseSize"
                required
            /></label>
          </h4>
          <br />
        </div>
        <div class="col-md-2 mb-4" style="top: 52px">
            <h4>
            <label class="font-weight-bold"
              >裝&nbsp;修&nbsp;工&nbsp;程&nbsp;進&nbsp;場&nbsp;日<br />
            <input
                type="date"
                class="form-control"
                v-model="cust[0].FavColor"
                 style="display: inline; width: 160px"
                :min="newdate"
            />
              <button
                @click.prevent="FClear"
                class="clearbutton"
              >
                X</button
              >
            </label>
          </h4>
          <br />
            <h4>
            <label class="font-weight-bold"
              >木&nbsp;作&nbsp;工&nbsp;程&nbsp;完&nbsp;成&nbsp;日<br />
              <input
                type="date"
                class="form-control"
                v-model="cust[0].Woodwork"
                 style="display: inline; width: 160px"
                :min="newdate"
            />
               <button
                @click.prevent="WClear"
                class="clearbutton"
                :disabled="state == 1"
              >
                X</button
              ></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;修&nbsp;工&nbsp;程&nbsp;退&nbsp;場&nbsp;日<br />
             <input
                type="date"
                class="form-control"
                v-model="cust[0].LastModify"
                 style="display: inline; width: 160px"
                :min="newdate"
                required
            />
              <button
                @click.prevent="LClear"
                class="clearbutton"
                :disabled="state == 1"
              >
                X</button
              ></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >沙&nbsp;&nbsp;發&nbsp;&nbsp;合&nbsp;&nbsp;約&nbsp;&nbsp;金&nbsp;額<br />
              <input type="text" class="form-control" v-model="cust[0].Fax"
            /></label>
          </h4>
        </div>
      </div>
       <h2>
          <label class="font-weight-bold" style="color: #ff5151"
            >接待時獲得資訊</label
          >
        </h2><br />
      <div class="row" style="height: 180px">
        <div class="col-md-4 mb-4">
          <h4>
            <label class="font-weight-bold" style="color: #ff5151"
              >為甚麼選擇MH</label
            >
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[0].memo"
            
          />
        </div>
        <div class="col-md-4 mb-4">
          <h4>
            <label class="font-weight-bold" style="color: #ff5151"
              >預算配比、使用成員、Key Man</label
            >
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[1].memo"
             
          />
        </div>
        <div class="col-md-4 mb-4">
          <h4>
            <label class="font-weight-bold" style="color: #ff5151"
              >屋況條件、客戶需求與喜好</label
            >
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[2].memo"
            
          />
        </div>
      </div>
      <div class="row" style="height: 180px">
        <div class="col-md-4 mb-4">
          <br />
          <h4>
            <label class="font-weight-bold" style="color: #ff5151"
              >急迫性(客變、入住時間或檔期)</label
            >
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[3].memo"
             
          />
        </div>
        <div class="col-md-4 mb-4">
          <br />
          <h4>
            <label class="font-weight-bold" style="color: #ff5151"
              >競爭比較者</label
            >
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[4].memo"
            
          />
        </div>
        <div class="col-md-4 mb-4">
          <br />
          <h4>
            <label class="font-weight-bold" style="color: #ff5151">其他</label>
          </h4>
          <input
            type="textarea"
            style="height: 100px"
            class="form-control"
            v-model="Cmemo[5].memo"
            
          />
        </div>
      </div>
      <button @click.prevent="save" type="submit">Post</button>
    </form>
  </div>
</template>

<script>
const axios = require("axios");
export default {
  name: "CMcreate",
  data() {
    return {
       newdate:new Date(Date.now()).toISOString().slice(0,10),
      space: [
        { type: "|規劃空間", value: "false", data: "全室" },
        { type: "|規劃空間", value: "false", data: "客廳" },
        { type: "|規劃空間", value: "false", data: "更衣室" },
        { type: "|規劃空間", value: "false", data: "廚房" },
        { type: "|規劃空間", value: "false", data: "餐廳" },
        { type: "|規劃空間", value: "false", data: "書房" },
        { type: "|規劃空間", value: "false", data: "玄關" },
        { type: "|規劃空間", value: "false", data: "臥室" },
        { type: "|規劃空間", value: "false", data: "其他" },
      ],
      likeStyle: [
        { type: "|喜好風格", value: "false", data: "鄉村風" },
        { type: "|喜好風格", value: "false", data: "現代風" },
        { type: "|喜好風格", value: "false", data: "工業風" },
        { type: "|喜好風格", value: "false", data: "北歐風" },
        { type: "|喜好風格", value: "false", data: "古典風" },
        { type: "|喜好風格", value: "false", data: "其他" },
      ],
      UDS: [
        { type: "|同業了解", value: "false", data: "歐德" },
        { type: "|同業了解", value: "false", data: "綠的傢俱" },
        { type: "|同業了解", value: "false", data: "艾菲爾" },
        { type: "|同業了解", value: "false", data: "室內設計師" },
        { type: "|同業了解", value: "false", data: "其他" },
      ],
      UseExp: [
        { type: "|使用經驗", value: "false", data: "使用過系統傢俱" },
        { type: "|使用經驗", value: "false", data: "曾有裝修經驗" },
        { type: "|使用經驗", value: "false", data: "使用過木地板" },
        { type: "|使用經驗", value: "false", data: "購買過沙發" },
      ],
      cust: [
        {
          CustName: "",
          CustSname: "",
          CustNo: "",
          TelDay: "",
          Mobil: "",
          Fax: "",
          TelNight: "",
          CusAddress: "",
          FittingAdd: "",
          CustType: "",
          Gender: "",
          Married: "",
          Kids: "",
          HouseSize: "",
          BuyReason: "",
          FavColor: "",
          Budget: "",
          PorductType: "",
          ZipCode: "",
          LastUse: "",
          UserId: "",
          Designer: "",
          LastModify: "",
          DataCreate: "",
          Meno: "",
          Birthday: "",
          門市別: "",
          email: "",
          msrep: "",
          COMPANY: "",
          identification: "",
          principal: "",
          dismantle: "",
          HouseDate: "",
          MemberCount: "",
          FinishDate: "",
          CheckInDate: "",
          budgetTot: "",
          budgetCabinet: "",
          budgetFloor: "",
          budgetSofa: "",
          BuildName: "",
          Woodwork: "",
          needChk: "true",
          HouseType: "",
          Family: "",
        },
      ],
      CustType: [],
      BuyReason: [],
      Family: [],
      HouseType: [],
      Cmemo: [
        { memo: "" },
        { memo: "" },
        { memo: "" },
        { memo: "" },
        { memo: "" },
        { memo: "" },
      ],
      Gender: [
        { value: 1, data: "先生" },
        { value: 0, data: "小姐" },
      ],
      test: true,

      addresschoose:[],
      CusAddressC:[],
      CusAddressS:[],
      FittingAddC:[],
      FittingAddS:[],
      data:[],
      zip:[],
      street:[{value:""}],
      addressState:true,
      stateA:1
    };
  },
  methods: {
      getaddress: function(){
          axios
          .get("/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
           this.stateA=2;
    },
    getcusaddress: function(){
      this.addressState=true;
      this.stateA=1;
      this.street[0].value="";
    },
    getfitaddress: function(){
        this.addressState=false;
        this.stateA=1;
         this.street[0].value="";
    },
    sendaddress: function () {
      if(this.addressState==true){
          this.CusAddressC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.CusAddressS = this.addresschoose.街路;
       this.cust[0].CusAddress = this.addresschoose.縣市+this.addresschoose.區鄉鎮市+this.addresschoose.街路;
         axios
          .get("/api/search/zip/"+this.CusAddressC)
          .then((response) => {
            console.log(response.data);
            this.cust[0].ZipCode = response.data;
            this.zip = response.data;
          });
      }
      if(this.addressState==false){
          this.FittingAddC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.FittingAddS = this.addresschoose.街路;
       this.cust[0].FittingAdd = this.addresschoose.縣市+this.addresschoose.區鄉鎮市+this.addresschoose.街路;
      }
    },
    save: function () {
      this.cust[0]["CusAddress"] = this.CusAddressC + this.CusAddressS;
       this.cust[0]["FittingAdd"] = this.FittingAddC + this.FittingAddS;
      axios
        .post("/api/Create/CMCRFItems", {
          UseExp: this.UseExp,
          UDS: this.UDS,
          likeStyle: this.likeStyle,
          space: this.space,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });

      axios
        .post("/api/Create/CmMemo", {
          Cmemo: this.Cmemo,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
     axios
        .post("/api/Create/CM", {
          cust: this.cust,
          CustType: this.CustType,
          BuyReason: this.BuyReason,
          Family: this.Family,
          HouseType: this.HouseType,
          Cmemo: this.Cmemo,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
    this.$emit('my-event', this.msg)
    },
     FClear: function () {
      this.cust[0].FavColor = '';
    },
    LClear: function () {
      this.cust[0].LastModify = '';
    },
    WClear: function () {
      this.cust[0].Woodwork = '';
    },
  },
  props: {
    msg: String,
  },
  beforeCreate() {
    axios
      .get("/api/search/CTD/客來源")
      .then((response) => {
        console.log(response.data.Cust);
        this.CustType = response.data;
      }),
      axios
        .get("/api/search/CTD/買原因")
        .then((response) => {
          console.log(response.data);
          this.BuyReason = response.data;
        }),
      axios
        .get("/api/search/CTD/成員組合")
        .then((response) => {
          console.log(response.data);
          this.Family = response.data;
        }),
      axios
        .get("/api/search/CTD/屋型")
        .then((response) => {
          console.log(response.data);
          this.HouseType = response.data;
        });
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.tableborder {
  width: 950px;
  margin: 0px auto;
}
.AF1tableborder {
  width: 950px;
  margin: 0px auto;
}
.bordertopic {
  width: 10%;
  font-size: 20px;
  margin: 0px auto;
  text-align: center;
  font-weight: solid;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.AF-checkbox {
  width: 20%;
  height: 50px;
  margin: 0px auto;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.AF-tablecheckbox {
  width: 30%;
  height: 100px;
  margin: 0px auto;
  padding: 0px 0px 0px 0px;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.AF11tableborder-250wid {
  font-size: 10px;
  border: 1px black solid;
}
.AF-tabletext {
  width: 40%;
  height: 100px;
  margin: 0px auto;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.AF-space {
  width: 1%;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.tablecheckbox {
  width: 350px;
  height: 100px;
  margin: 0px auto;
  padding: 0px 0px 0px 0px;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.text-a-center {
  text-align: center;
}
.textw3 {
  width: 3%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw5 {
  width: 5%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw5px {
  width: 5px;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw10 {
  width: 50px;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw12 {
  width: 12%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw20 {
  width: 20%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw200px {
  width: 200px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw30 {
  width: 30%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw50 {
  width: 50%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.topic {
  position: relative;
  margin-top: 10px;
  right: 250px;
}
</style>
