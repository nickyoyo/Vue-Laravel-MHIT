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

<a style="position:relative;left:800px;" v-if="loadin">
  <loader></loader>
</a>
<a v-else>
<a v-if="choose" style="position:relative;left:520px;top:300px;">
      <CMpageDaymanage @my-event="DaymanageB" v-bind:CNO="CNO" v-bind:Dept="Dept"></CMpageDaymanage>
</a>
 <a v-else style="position:relative;left:300px;">
  <div
    style="
      position: relative;
      height: 1px;
      bottom: 80px;
      width: 1200px;
      margin: 0px auto;
    "
  >
    <div class="topic" style="text-align: center">
      <h1>客戶資料</h1>
    </div>
    <br />
    <div class="AF2topic">
     <button @click.prevent="Daymanage" type="submit">日程管理</button>&nbsp;
      <input type="button" onclick="location.href='/AFeature1'" value="團購" />
      &nbsp;
      <button @click.prevent="Modify" type="submit">資料修改</button>&nbsp;
      <input
        type="button"
        onclick="location.href='/AFeature1'"
        value="設計師或仲介請款"
      />
      &nbsp;
      <input
        type="button"
        onclick="location.href='/AFeature1'"
        value="設計師或仲介"
      />
      &nbsp;
      <input
        type="button"
        onclick="location.href='/AFeature1'"
        value="印預收款"
      />
      &nbsp;
      <input
        type="button"
        onclick="location.href='/AFeature1'"
        value="未入帳裝修工程"
      />
      &nbsp;
    </div>
    <br /><br /><br />
    <form action="/" v-on:submit.prevent="postdata">
      <div class="row" style="height: 800px">
        <div class="col-md-5 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >基本資料</label
            >
          </h2>
          <br />
          <h4>
            <label class="font-weight-bold"
              >客戶名稱
              <th style="width: 90%">
                <input
                  type="text"
                  class="form-control"
                  v-model="cust.CustName"
                  :readonly="state == 1"
                  style="width:300px"
                />
              </th>
              <th style="padding: 5px">
                <select
                  style="height: 45px"
                  id="Gender"
                  name="Gender"
                  v-model="cust.Gender"
                  :disabled="state == 1"
                >
                  <option
                    v-for="item in Gender"
                    :value="item.value"
                    :key="item.value"
                  >
                    {{ item.data }}
                  </option>
                </select>
              </th></label
            >
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >公司名稱
              <input
                type="text"
                class="form-control"
                v-model="cust.COMPANY"
                :readonly="state == 1"
                style="width:300px"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >E-Mail
              <input
                type="text"
                class="form-control"
                v-model="cust.email"
                :readonly="state == 1"
                style="width:300px"
            /></label>
          </h4>
          <br />
          <h4><label class="font-weight-bold"  style="display:inline">通訊地址</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="custT.CusAddressC"
            style="display:inline;width:130px"
            readonly
          /><input
            type="text"
            class="form-control"
            v-model="custT.CusAddressS"
             style="display:inline;width:270px"
              :readonly="state == 1"
          />
          <button @click.prevent="getcusaddress" type="button" class="btn btn-primary"  style="display:inline" data-toggle="modal" data-target="#ooo" :disabled="state == 1">S</button>
          <br />
          <h4><label class="font-weight-bold">安裝地址</label></h4>
           <input
            type="text"
            class="form-control"
            v-model="custT.FittingAddC"
            style="display:inline;width:130px"
            readonly
          />
          <input
            type="text"
            class="form-control"
            style="display:inline;width:270px"
            v-model="custT.FittingAddS"
             :readonly="state == 1"
          />
         <button @click.prevent="getfitaddress" type="button" class="btn btn-primary"  style="display:inline" data-toggle="modal" data-target="#ooo" :disabled="state == 1">S</button>
          <br />
           <h4><label class="font-weight-bold">建案名稱</label></h4>
          <input
            type="text"
            class="form-control"
            v-model="cust.BuildName"
            :readonly="state == 1"
            style="width:300px"
          /><br />
        </div>
        <div class="col-md-3 mb-4">
          <br /><br /><br />
          <h4>
            <label class="font-weight-bold"
              >身分證(統編)
              <input
                type="text"
                class="form-control"
                style="width: 200px"
                v-model="cust.identification"
                :readonly="state == 1"
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
                v-model="cust.principal"
                :readonly="state == 1"
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
                v-model="cust.TelDay"
                :readonly="state == 1"
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
                v-model="cust.Mobil"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
        </div>
        <div class="col-md-3 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >來源與經驗</label
            >
          </h2>
          <h4>
            <label class="font-weight-bold"
              >客戶來源:
              <select v-model="cust.CustType" :disabled="state == 1">
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
                <input
                  type="checkbox"
                  v-model="item.value"
                  :disabled="state == 1"
                />{{ item.data }}
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
                <input
                  type="checkbox"
                  v-model="item.value"
                  :disabled="state == 1"
                />{{ item.data }}
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
              <select v-model="cust.BuyReason" :disabled="state == 1">
                <option
                  v-for="item in BuyReason"
                  :value="item.codeindex"
                  :key="item.codeindex"
                  :disabled="state == 1"
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
                type="text"
                class="form-control"
                style="width: 50px"
                v-model="cust.TelNight"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >屋齡<br />
              <input
                type="text"
                class="form-control"
                style="width: 100px"
                v-model="cust.Birthday"
                :readonly="state == 1"
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
                v-model="custT.HouseDate"
                :min="newdate"
                :readonly="state == 1"
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
                v-model="cust.MemberCount"
                min="1"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >成員組合:
              <select v-model="cust.Family" :disabled="state == 1">
                <option
                  v-for="item in Family"
                  :value="item.codeindex"
                  :key="item.codeindex"
                  :disabled="state == 1"
                >
                  {{ item.codeDesc }}
                </option>
              </select></label
            >
          </h4>
          <br />
        </div>
        <div class="col-md-3 mb-4" style="top: 5px">
          <input
            type="checkbox"
            v-model="cust.needChk"
            :disabled="state == 1"
          />有丈量需求 <br /><br />
          <h4>
            <label class="font-weight-bold"
              >預計完工日<br />
              <el-date-picker
                class="form-control"
                style="width: 200px"
                v-model="custT.FinishDate"
                :readonly="state == 1"
                :picker-options="pickerOptions0">
            </el-date-picker></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >入厝時間<br />
              <input
                type="date"
                class="form-control"
                style="width: 200px"
                v-model="custT.CheckInDate"
                :readonly="state == 1"
                :min="newdate"
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
              :value="item.value"
              :key="item.data"
              style="height: 25px"
            >
              <input
                type="checkbox"
                v-model="item.value"
                :disabled="state == 1"
              />{{ item.data }}
            </div>
          </div>
          <br />

          <h4>
            <label class="font-weight-bold"
              >屋型
              <select v-model="cust.HouseType" :disabled="state == 1">
                <option
                  v-for="item in HouseType"
                  :value="item.codeindex"
                  :key="item.codeindex"
                  :disabled="state == 1"
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
              <input
                type="checkbox"
                v-model="item.value"
                :disabled="state == 1"
              />{{ item.data }}
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
                v-model="cust.budgetTot"
                :readonly="state == 1"
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
                v-model="cust.budgetFloor"
                :readonly="state == 1"
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
                v-model="cust.budgetCabinet"
                :readonly="state == 1"
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
                v-model="cust.budgetSofa"
                :readonly="state == 1"
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
                v-model="cust.Budget"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;&nbsp;修&nbsp;&nbsp;未&nbsp;&nbsp;稅&nbsp;&nbsp;成本<br />
              <input
                type="text"
                class="form-control"
                v-model="cust.LastUse"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >拆&nbsp;&nbsp;除&nbsp;&nbsp;運&nbsp;&nbsp;送&nbsp;&nbsp;金額<br />
              <input
                type="text"
                class="form-control"
                v-model="cust.dismantle"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
          <h4>
            <label class="font-weight-bold"
              >系統家具合約金額<br />
              <input
                type="text"
                class="form-control"
                v-model="cust.HouseSize"
                :readonly="state == 1"
            /></label>
          </h4>
          <br />
        </div>
        <div class="col-md-3 mb-4" style="top: 54px">
          <h4>
            <label class="font-weight-bold"
              >裝&nbsp;修&nbsp;工&nbsp;程&nbsp;進&nbsp;場&nbsp;日<br />
              <input
                type="date"
                class="form-control"
                style="display: inline; width: 180px"
                v-model="custT.FavColor"
                :readonly="state == 1"
                :min="newdate"
              />
              <button
                @click.prevent="FClear"
                class="clearbutton"
                :disabled="state == 1"
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
                style="display: inline; width: 180px"
                v-model="custT.Woodwork"
                :min="newdate"
                :readonly="state == 1" />
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
                style="display: inline; width: 180px"
                v-model="custT.LastModify"
                :min="newdate"
                :readonly="state == 1" />
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
              <input
                type="text"
                class="form-control"
                v-model="cust.Fax"
                :readonly="state == 1"
            /></label>
          </h4>
        </div>
      </div>
      <h2>
        <label class="font-weight-bold" style="color: #ff5151"
          >接待時獲得資訊</label
        >
      </h2>
      <br />
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
            :readonly="state == 1"
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
            :readonly="state == 1"
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
            :readonly="state == 1"
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
            :readonly="state == 1"
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
            :readonly="state == 1"
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
            :readonly="state == 1"
          />
        </div>
      </div>
      <button @click.prevent="save" type="submit" :hidden="state == 1">
        修改完成
      </button>
    </form>
  </div>
  </a>
  </a>
</template>

<script>
import CMpageDaymanage from "./CM日程管理";
import loader from "../test/Loader.vue";
const axios = require("axios");
export default {
  components: { CMpageDaymanage,loader },
  name: "CMpage",
  data() {
    return {
      newdate:new Date(Date.now()).toISOString().slice(0,10),
       pickerOptions0: {
          disabledDate(time) {
            return time.getTime() < Date.now();
          }
        },  
      state: this.$route.params.state,
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
        { type: "|使用經驗", value: "false", data: "使用過系統家具" },
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
      custT: [],
      CustType: [],
      BuyReason: [],
      Family: [],
      HouseType: [],
      Cmemo: [],
      Gender: [
        { value: "0", data: "小姐" },
        { value: "1", data: "先生" },
      ],

      addresschoose:[],
      data:[],
      zip:[],
      street:[{value:"empty"}],
      addressState:true,
      stateA:1,

      choose: false,
      CNO:this.$route.params.CNO,
      Dept:[],
      loadin:true,
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
          this.custT.CusAddressC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.custT.CusAddressS = this.addresschoose.街路;
       this.cust.CusAddress = this.addresschoose.縣市+this.addresschoose.區鄉鎮市+this.addresschoose.街路;
         axios
          .get("/api/search/zip/"+this.CusAddressC)
          .then((response) => {
            console.log(response.data);
            this.cust.ZipCode = response.data;
            this.zip = response.data;
          });
      }
      if(this.addressState==false){
          this.custT.FittingAddC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.custT.FittingAddS = this.addresschoose.街路;
       this.cust.FittingAdd = this.addresschoose.縣市+this.addresschoose.區鄉鎮市+this.addresschoose.街路;
      }
    },
    Modify: function () {
      this.state = 2;
    },
    FClear: function () {
      this.custT.FavColor = '';
    },
    LClear: function () {
      this.custT.LastModify = '';
    },
    WClear: function () {
      this.custT.Woodwork = '';
    },
    save: function () {
      this.cust.CusAddress = this.custT.CusAddressC + this.custT.CusAddressS;
       this.cust.FittingAdd = this.custT.FittingAddC + this.custT.FittingAddS;
      axios
        .post("/api/Update/CM", {
          cust: this.cust,
          custT: this.custT,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
      axios
        .post("/api/Update/CMCRFItems", {
          cust: this.cust,
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
        .post("/api/Update/CmMemo", {
          cust: this.cust,
          Cmemo: this.Cmemo,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (response) {
          console.log(response);
        });
      this.refresh();
    },
    Daymanage: function(){
         this.choose = true;
    },
    DaymanageB: function(){
          this.choose = false;
    },
    refresh: function(){
      let that = this;
      this.loadin = true;
      this.state=1,
        axios
        .get("/api/search/CM/" + this.CNO)
        .then((response) => {
          console.log(response);
          this.cust = response.data[0];
          this.custT = response.data;
          this.CusAddressC = response.data.CusAddressC;
          this.CusAddressS = response.data.CusAddressS;
          this.FittingAddC = response.data.FittingAddC;
          this.FittingAddS = response.data.FittingAddS;
          that.loadin = false;
        }),
        axios
          .get(
            "/api/search/CMCRFItems/" +
              this.CNO
          )
          .then((response) => {
            console.log(response.data);

            for (let i = 0; i < 4; i++)
              this.UseExp[i]["value"] = response.data[0][i];
            for (let i = 0; i < 5; i++)
              this.UDS[i]["value"] = response.data[1][i];
            for (let i = 0; i < 6; i++)
              this.likeStyle[i]["value"] = response.data[2][i];
            for (let i = 0; i < 9; i++)
              this.space[i]["value"] = response.data[3][i];
          }),
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
      axios
        .get(
          "/api/search/CmMemo/" +
            this.CNO +
            "&&00"
        )
        .then((response) => {
          console.log(response.data);
          this.Cmemo = response.data;
        });
    }
  },
  props: {
    msg: String,
  },
  beforeCreate() {
    if (this.$route.params.CNO != "") {
      let that = this;
      axios
        .get("/api/search/CM/" + this.$route.params.CNO)
        .then((response) => {
          console.log(response);
          this.cust = response.data[0];
          this.Dept = response.data[0].門市別;
          this.custT = response.data;
          this.CusAddressC = response.data.CusAddressC;
          this.CusAddressS = response.data.CusAddressS;
          this.FittingAddC = response.data.FittingAddC;
          this.FittingAddS = response.data.FittingAddS;
          this.loadin =false;
          if (response.data[0] == null) {
            const message = "此客編不存在";
            this.$router.push({ path: "/CM/sendSearch", params: { message } });
          }
        }),
        axios
          .get(
            "/api/search/CMCRFItems/" +
              this.$route.params.CNO
          )
          .then((response) => {
            console.log(response.data);

            for (let i = 0; i < 4; i++)
              this.UseExp[i]["value"] = response.data[0][i];
            for (let i = 0; i < 5; i++)
              this.UDS[i]["value"] = response.data[1][i];
            for (let i = 0; i < 6; i++)
              this.likeStyle[i]["value"] = response.data[2][i];
            for (let i = 0; i < 9; i++)
              this.space[i]["value"] = response.data[3][i];
          }),
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
      axios
        .get(
          "/api/search/CmMemo/" +
            this.$route.params.CNO +
            "&&00"
        )
        .then((response) => {
          console.log(response.data);
          this.Cmemo = response.data;
        });
    } else {
      const message = "此客編不存在";
      this.$router.push({ name: "CMsendSearch", query: { message } });
    }
  },
};
</script>

<style>
.topic {
  position: relative;
  margin-top: 10px;
  margin-left: 450px;
}
.AF2topic {
  position: absolute;
  left: 16%;
}
.AF11tableborder-250wid {
  font-size: 10px;
  width:300px;
  border: 1px black solid;
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
.clearbutton {
  text-align: center;
  display: inline;
  font-size: 15px;
  width: 30px;
  height: 30px;
  color: red;
  border: 2px solid #2d302d;
}
</style>
