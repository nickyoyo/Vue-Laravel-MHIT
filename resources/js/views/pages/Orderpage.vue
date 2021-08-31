<template>
  <div id="loading" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-sm" >
            <loader></loader>
      </div>
  </div>

  <a style="position: relative; left: 100px">
    <div
      style="
        position: relative;
        height: 1px;
        bottom: 80px;
        width: 1600px;
        margin: 0px auto;
      "
    >
      <div class="topic" style="text-align: center">
        <h1>報價訂單資料</h1>
      </div>
      <br />
      <div class="AF2topic">
        <button @click.prevent="Daymanage" type="submit">日程管理</button>&nbsp;
        <input
          type="button"
          onclick="location.href='/AFeature1'"
          value="團購"
        />
        &nbsp;
        <button @click.prevent="Modify" type="submit">資料修改</button>&nbsp;
      </div>
      <br />

      <div class="row" style="height: 700px">
        <div class="col-md-5 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >報價訂單列表</label
            >
          </h2>
          <div
            class="container text-center"
            style="
              overflow-y: scroll;
              height: 350px;
              width: 500px;
              border: 1px black solid;
            "
          >
            <table class="container" style="border: 1px black solid">
              <thead>
                <tr style="border: 1px black solid">
                  <th class="orderth1">狀態</th>
                  <th class="orderth2">X</th>
                  <th class="orderth3" style="color: blue">報價單號</th>
                  <th class="orderth4">訂單總額</th>
                  <th></th>
                </tr>
              </thead>
              <tr
                v-for="(item, index) in OrderList"
                :value="item"
                :key="index"
                style="border: 1px black solid"
                :hidden="show == 1"
              >
                <td class="orderth1">訂單</td>
                <td class="orderth2"></td>
                <td v-if="Selectorder==index" style="color:red;font-weight:bold;" class="orderth3">{{ item.QuotNo }}</td>
                <td v-else class="orderth3">{{ item.QuotNo }}</td>
                <td class="orderth4">{{ item.TotalValue }}</td>
                <td><button @click="GetOrderDetail(index)">明細</button></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="col-md-3 mb-4" style="border: 1px black solid; padding:5px;">
          <table>
      
            <td>分類</td>
            <td>
              <input
                type="text"
                style="height: 40px; width: 50px; text-align: center"
                v-model="OrderData[0].OrderType"
                readonly
              />
            </td>
            <td>-</td>
            <td>
                <input
                type="text"
                style="height: 40px; width: 120px"
                v-model="OrderDataCTDtype"
                readonly
              />
            </td>
          </table>
          <br />
          <table>
            <th>
              安裝地址
              <br />
              <input
                type="text"
                style="height: 30px; width: 50px;"
                v-model="OrderData[0].ZIP"
                readonly
              />
            </th>
            <th>
              <textarea
                style="
                  width: 300px;
                  height: 80px;
                  display: inline;
                  vertical-align: middle;"
                  v-model="OrderData[0].addr"
                readonly
              ></textarea>
            </th>
          </table>
          <br />
          <label class="font-weight-bold"
            >Memo&nbsp;&nbsp;&nbsp;
            <textarea
              style="
                width: 300px;
                height: 80px;
                display: inline;
                vertical-align: middle;"
                v-model="OrderDataMemo"
              readonly
            ></textarea>
          </label>
          <br /><br />
            &nbsp;送: 
          <input
            type="text"
            style="height: 30px; width: 90px; display: inline"
            v-model="OrderDataFINST.TransDate"
            readonly
          />
            &nbsp;&nbsp;裝: 
           <input
            type="text"
            style="height: 30px; width: 90px; display: inline"
            v-model="OrderDataFINST.SetDate"
            readonly
          />
            &nbsp;&nbsp;出: 
           <input
            type="text"
            style="height: 30px; width: 90px; display: inline"
            v-model="OrderData[0].DispatchDate"
            readonly
          />
          <br />
        </div>
        <div style="width:20px;"></div>

        <div style="width:180px;">
          <table class="container " style="padding:10px;text-align: right">
             <tr><td style="height: 40px;">
               專案顧問&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.EMID" readonly />
            </td></tr>  
              <tr><td style="height: 40px;">
                中文名&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.EMME" readonly />
            </td></tr>  
    <tr><td style="height: 15px;"></td></tr>
            <tr><td style="height: 40px;">
               報價&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].QuotDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
               檔期&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].PromotionPeriod" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
               簽約&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].OrderDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
               <button>預計完款</button>&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].ExpireDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
               <button>預計安裝</button>&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].RequireDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                完款&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].ClearDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>   
            <tr><td style="height: 40px;">
                揀貨&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].PickingDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                確出&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].AppDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                損益&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].ProfitDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                完工&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataFINST.InspectDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                檢日&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataFINST.CheckDate" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                驗收&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataFINST.CloseDate" readonly />
            </td></tr>     
     
          </table>
        </div>

         <div style="width:20px;"></div>

        <div style="width:180px;">
          <table class="container " style="padding:10px;text-align: right">
            <tr><td style="height: 40px;">
                門市別&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.DVID" readonly />
            </td></tr>  
              <tr><td style="height: 40px;">
                英文名&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.ENME" readonly />
            </td></tr>  
    <tr><td style="height: 15px;"></td></tr>
            <tr><td style="height: 40px;">
               訂單總額&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].TotalValue" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                <button>額外施工</button>&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].exwork" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                帳單金額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                訂單餘額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                實收金額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                折讓金額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>   
            <tr><td style="height: 40px;">
                應收金額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                代墊餘額&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                定規櫥櫃&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                訂製櫃體&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
    <tr><td style="height: 10px;"></td></tr>
            <tr><td style="height: 40px;">
                配件&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>
            <tr><td style="height: 40px;">
                結案&nbsp;<input type="text" style="height: 30px; width: 90px;" readonly />
            </td></tr>     
     
          </table>
        </div>

      </div>

      <div class="row" style="height: 500px">
        <div class="col-md-11 mb-4">
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >報價訂單明細</label
            >
          </h2>
          <div
            style="
              overflow-y: scroll;
              height: 400px;
              width: 1600px;
              border: 1px black solid;
            "
          >
            <table style="border: 1px black solid; width: 1580px">
              <thead>
                <tr style="border: 1px black solid">
                  <th class="Dorderth1">項次</th>
                  <th class="Dorderth2">色號</th>
                  <th class="Dorderth3">料號</th>
                  <th class="Dorderth4">定價</th>
                  <th class="Dorderth5">訂單量</th>
                  <th class="Dorderth6">折扣率</th>
                  <th class="Dorderth7">金額</th>
                  <th class="Dorderth8">是否有採購單</th>
                  <th class="Dorderth9">新增</th>
                </tr>
              </thead>
              <tr
                v-for="(itemD, index) in OrderDetailitem"
                :value="itemD"
                :key="index"
                style="border: 1px black solid"
                :hidden="show == 1"
              >
                <th class="Dorderth1">{{ index + 1 }}</th>
                <th class="Dorderth2">  {{ itemD.Ragne }}<br /><a style="color: green">
                     {{ itemD.RangeName}}
                    </a></th>
                <th class="Dorderth3">
                  {{ itemD.SalesCode }}<br /><a style="color: blue"
                    >{{ itemD.SalesCodeData.Description }}[{{
                      itemD.SalesCodeData.SupplierNo
                    }}]</a
                  >
                </th>
                <th class="Dorderth4">{{ itemD.UnitPrice }}</th>
                <th class="Dorderth5">{{ itemD.Qty }}</th>
                <th class="Dorderth6">{{ itemD.DiscountRate }}</th>
                <th class="Dorderth7">{{ itemD.OrderValue }}</th>
                <th class="Dorderth8"><a style="color:red" :hidden="itemD.poCheck==0">有採購單</a></th>
                <th class="Dorderth9">
                  {{ itemD.OrderDate }}<br />{{ itemD.Ordermember }}
                </th>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-1 mb-4"></div>
      </div>

    </div>
  </a>
</template>

<script>
import loader from "../test/Loader.vue";
const axios = require("axios");
export default {
  components: { loader },
  name: "Orderpage",
  data() {
    return {
      OrderList: [],
      OrderData: [{
          OrderType:'',
      }],
      OrderDataMemo: "",
      OrderDataCTDtype: "",
      OrderDetailitem: [],
      OrderDataFINST: [],
      OrderDataEM: [],
      Selectorder:-1,
    };
  },
  methods: {
    GetOrderDetail: function (index) {
      this.Selectorder=index;
       $("#loading").modal('toggle');
      axios
        .get("/api/search/OrderDetailitem/" + this.OrderList[index].QuotNo)
        .then((response) => {
          console.log(response.data);
          this.OrderDetailitem = response.data;
         $("#loading").modal('toggle');
        });
      axios
        .get("/api/search/Orderdata/" + this.OrderList[index].QuotNo)
        .then((response) => {
          console.log(response);
          this.OrderData = response.data;
           axios
            .get("/api/search/CTD/Desc/訂單類&&" + this.OrderData[0].OrderType)
            .then((response) => {
                console.log(response);
                this.OrderDataCTDtype = response.data.codeDesc;
            });
            axios
            .get("/api/search/CmMemo/" + this.OrderData[0].QuotNo +"&&02")
            .then((response) => {
                console.log(response);
                this.OrderDataMemo = response.data.memo;
            });
            axios
            .get("/api/search/OrderFINST/" + this.OrderData[0].QuotNo)
            .then((response) => {
                console.log(response);
                this.OrderDataFINST = response.data;
            });
            axios
            .get("/api/search/PD/" + this.OrderData[0].UserId)
            .then((response) => {
                console.log(response);
                this.OrderDataEM = response.data;
            });
        });
    },
  },
  props: {
    msg: String,
  },
  beforeCreate() {
      $("#loading").modal('toggle');
    axios
      .get("/api/search/Order/" + this.$route.params.CNO)
      .then((response) => {
        console.log(response);
        this.OrderList = response.data[0];
        $("#loading").modal('hide');
        if (response.data == null) {
          const message = "此客編不存在";
          this.$router.push({ path: "/Order/sendSearch", params: { message } });
        }
      });
  },
};
</script>

<style>
thead tr th {
  position: sticky;
  top: 0;
}
.topic {
  position: relative;
  margin-top: 10px;
  margin-left: 450px;
}
.orderth1 {
  width: 10%;
  text-align: center;
}
.orderth2 {
  width: 10%;
  text-align: center;
  border: 1px black solid;
}
.orderth3 {
  width: 50%;
  text-align: center;
}
.orderth4 {
  width: 15%;
  text-align: center;
  border: 1px black solid;
}

.Dorderth1 {
  width: 3%;
  text-align: center;
}
.Dorderth2 {
  width: 8%;
  text-align: center;
  border: 1px black solid;
}
.Dorderth3 {
  width: 35%;
}
.Dorderth4 {
  width: 5%;
  text-align: center;
  border: 1px black solid;
}
.Dorderth5 {
  width: 5%;
  text-align: center;
}
.Dorderth6 {
  width: 5%;
  text-align: center;
  border: 1px black solid;
}
.Dorderth7 {
  width: 5%;
  text-align: center;
}
.Dorderth8 {
  width: 9%;
  text-align: center;
  border: 1px black solid;
}
.Dorderth9 {
  width: 10%;
  text-align: center;
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
