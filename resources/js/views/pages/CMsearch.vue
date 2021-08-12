<template>
  <div
    style="
      position: absolute;
      left: 300px;
      height: 90px;
      width: 1100px;
      margin: 0px auto;"
  >
    <div class="topic" style="text-align: center;">
      <h1>客戶資料</h1>
    </div><br />
    <div class="AF2topic">
      <input
        type="button"
        onclick="location.href='/AFeature1'"
        value="貴賓卷"
      />&nbsp;
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
    <div class="row" style="height: 750px">
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
                :readonly="disable == 0"
              />
            </th>
            <th style="padding: 5px">
              <select
                style="height: 40px"
                id="Gender"
                name="Gender"
                v-model="cust.Gender"
                :disabled="disable == 0"
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
              readonly
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
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >通訊地址
            <input
              type="text"
              class="form-control"
              style="width: 400px"
              v-model="cust.CusAddress"
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >安裝地址
            <input
              type="text"
              class="form-control"
              v-model="cust.FittingAdd"
              style="width: 400px"
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >建案名稱
            <input
              type="text"
              class="form-control"
              v-model="cust.BuildName"
              readonly
          /></label>
        </h4>
        <br />
      </div>
      <div class="col-md-4 mb-4">
        <br /><br /><br />
        <h4>
          <label class="font-weight-bold"
            >身分證(統編)
            <input
              type="text"
              class="form-control"
              style="width: 200px"
              v-model="cust.identification"
              readonly
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
              readonly
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
              readonly
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
              readonly
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
            <select v-model="cust.CustType" disabled>
              <option
                v-for="item in CustType"
                :value="item.codeindex"
                :key="item.codeindex"
              >
                <a v-if="cust.CustType === item.codeindex">{{
                  item.codeDesc
                }}</a>
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
                <input type="checkbox" v-model="item.value" disabled />{{item.data}}
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
             <input type="checkbox" v-model="item.value" disabled />{{item.data}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="height: 750px;">
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
            <select v-model="cust.BuyReason" disabled>
              <option
                v-for="item in BuyReason"
                :value="item.codeindex"
                :key="item.codeindex"
                disabled
              >
                <a v-if="cust.BuyReason === item.codeindex">{{
                  item.codeDesc
                }}</a>
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
              readonly
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
              readonly
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
              readonly
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
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >成員組合:
            <select v-model="cust.Family" disabled>
              <option
                v-for="item in Family"
                :value="item.codeindex"
                :key="item.codeindex"
                disabled
              >
                <a v-if="cust.Family === item.codeindex">{{ item.codeDesc }}</a>
              </option>
            </select></label
          >
        </h4>
        <br />
      </div>
      <div class="col-md-3 mb-4" style="top: 50px">
        <br /><br /><br />
        <input
          id="needChk"
          name="needChk"
          type="checkbox"
          class="custom-control-input"
          checked
        />
        <label class="custom-control-label" for="credit" readonly
          >有丈量需求</label
        ><br /><br />
        <h4>
          <label class="font-weight-bold"
            >預計完工日<br />
            <input
              type="date"
              class="form-control"
              style="width: 200px"
              v-model="custT.FinishDate"
              readonly
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
              v-model="custT.CheckInDate"
              readonly
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
             <input type="checkbox" v-model="item.value" disabled />{{item.data}}
          </div>
        </div>
        <br />

        <h4>
          <label class="font-weight-bold"
            >屋型
            <select v-model="cust.HouseType" disabled>
              <option
                v-for="item in HouseType"
                :value="item.codeindex"
                :key="item.codeindex"
                disabled
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
           <input type="checkbox" v-model="item.value" disabled />{{item.data}}
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
              readonly
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
              readonly
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
              readonly
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
              readonly
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
              readonly
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
              readonly
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
              readonly
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
              readonly
          /></label>
        </h4>
        <br />
      </div>
      <div class="col-md-2 mb-4" style="top: 54px">
        <h4>
          <label class="font-weight-bold"
            >裝&nbsp;修&nbsp;工&nbsp;程&nbsp;進&nbsp;場&nbsp;日<br />
            <input
              type="date"
              class="form-control"
              v-model="custT.FavColor"
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >木&nbsp;作&nbsp;工&nbsp;程&nbsp;完&nbsp;成&nbsp;日<br />
            <input
              type="date"
              class="form-control"
              v-model="custT.Woodwork"
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >裝&nbsp;修&nbsp;工&nbsp;程&nbsp;退&nbsp;場&nbsp;日<br />
            <input
              type="date"
              class="form-control"
              v-model="custT.LastModify"
              readonly
          /></label>
        </h4>
        <br />
        <h4>
          <label class="font-weight-bold"
            >沙&nbsp;&nbsp;發&nbsp;&nbsp;合&nbsp;&nbsp;約&nbsp;&nbsp;金&nbsp;額<br />
            <input type="text" class="form-control" v-model="cust.Fax" readonly
          /></label>
        </h4>
      </div>
    </div>
       <div class="row" style="height: 180px">
        <h2>
          <label class="font-weight-bold" style="color: #ff5151"
            >接待時獲得資訊</label
          >
        </h2>
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
            readonly
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
            readonly
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
            readonly
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
            readonly
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
            readonly
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
            readonly
          />
        </div>
      </div>

  </div>
</template>

<script>
const axios = require("axios");
export default {
  name: "SearchCM",
  data() {
    return {
        disable:1,
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
        { type: "|使用經驗", value: "false", data: "使用過系統傢具" },
        { type: "|使用經驗", value: "false", data: "曾有裝修經驗" },
        { type: "|使用經驗", value: "false", data: "使用過木地板" },
        { type: "|使用經驗", value: "false", data: "購買過沙發" },
      ],
      cust: [],
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
    };
  },
  methods: {
    Modify: function () {
      const CNO = this.$route.params.CNO;
      this.$router.push({ name: "ModifyCM", params: { CNO } });
    },
  },
  props: {
    msg: String,
  },
  beforeCreate() {
    axios
      .get("http://127.0.0.1:8000/api/search/CM/" + this.$route.params.CNO)
      .then((response) => {
        console.log(response);
        this.cust = response.data[0];
        this.custT = response.data;
      }),
      axios
        .get(
          "http://127.0.0.1:8000/api/search/CMCRFItems/" +
            this.$route.params.CNO
        )
        .then((response) => {
          console.log(response.data);
          this.UseExp[0]["value"] = response.data[0][0];
          this.UseExp[1]["value"] = response.data[0][1];
          this.UseExp[2]["value"] = response.data[0][2];
          this.UseExp[3]["value"] = response.data[0][3];

          this.UDS[0]["value"] = response.data[1][0];
          this.UDS[1]["value"] = response.data[1][1];
          this.UDS[2]["value"] = response.data[1][2];
          this.UDS[3]["value"] = response.data[1][3];
          this.UDS[4]["value"] = response.data[1][4];

          this.likeStyle[0]["value"] = response.data[2][0];
          this.likeStyle[1]["value"] = response.data[2][1];
          this.likeStyle[2]["value"] = response.data[2][2];
          this.likeStyle[3]["value"] = response.data[2][3];
          this.likeStyle[4]["value"] = response.data[2][4];
          this.likeStyle[5]["value"] = response.data[2][5];

          for(i=0;i++;i<8)
          {
                this.space[i]["value"] = response.data[3][i];
          }
        }),
      axios
        .get("http://127.0.0.1:8000/api/search/CTD/客來源")
        .then((response) => {
          console.log(response.data.Cust);
          this.CustType = response.data;
        }),
      axios
        .get("http://127.0.0.1:8000/api/search/CTD/買原因")
        .then((response) => {
          console.log(response.data);
          this.BuyReason = response.data;
        }),
      axios
        .get("http://127.0.0.1:8000/api/search/CTD/成員組合")
        .then((response) => {
          console.log(response.data);
          this.Family = response.data;
        }),
      axios
        .get("http://127.0.0.1:8000/api/search/CTD/屋型")
        .then((response) => {
          console.log(response.data);
          this.HouseType = response.data;
        });
    axios
      .get(
        "http://127.0.0.1:8000/api/search/CmMemo/" +
          this.$route.params.CNO +
          "&&00"
      )
      .then((response) => {
        console.log(response.data);
        this.Cmemo= response.data;

      });
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
   width: 300px;
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
</style>
