<template>
  <a style="position: relative; left: 800px" v-if="loadin">
    <loader></loader>
  </a>
  <a v-else style="position: relative; left: 100px">
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
      <form action="/" v-on:submit.prevent="postdata">
        <div class="row" style="height: 400px">
          <div class="col-md-6 mb-4">
            <h2>
              <label class="font-weight-bold" style="color: #ff5151"
                >報價訂單列表</label
              >
            </h2>
            <div
              class="container text-center"
              style="overflow-y: scroll; height: 250px; width: 700px; border: 1px black solid;"
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
                <tr v-if="loadin">
                  <loader></loader>
                </tr>
                <tr
                  v-show="loadin == false"
                  v-for="(item, index) in OrderList"
                  :value="item"
                  :key="index"
                  style="border: 1px black solid"
                  :hidden="show == 1"
                >
                  <td class="orderth1">訂單</td>
                  <td class="orderth2"></td>
                  <td class="orderth3">{{ item.QuotNo }}</td>
                  <td class="orderth4">{{ item.TotalValue }}</td>
                  <td><button @click="showDetail(index)">明細</button></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-3 mb-4">


          </div>
           <div class="col-md-3 mb-4">


          </div>
        </div>

        <div class="row" style="height: 450px">
           <div class="col-md-11 mb-4">
            <h2>
              <label class="font-weight-bold" style="color: #ff5151"
                >報價訂單明細</label
              >
            </h2>
             <div
              style="overflow-y: scroll; height: 400px; width: 1600px; border: 1px black solid;"
            >
              <table style="border: 1px black solid;width: 1580px;">
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
                <tr v-if="loadinD">
                  <loader></loader>
                </tr>
                <tr
                  v-show="loadinD == false"
                  v-for="(itemD, index) in OrderDetail"
                  :value="itemD"
                  :key="index"
                  style="border: 1px black solid"
                  :hidden="show == 1"
                >
                  <th class="Dorderth1">{{index+1}}</th>
                  <th class="Dorderth2"></th>
                  <th class="Dorderth3">{{itemD.SalesCode}}<br/><a style="color:blue;">{{itemD.SalesCodeData.Description}}[{{itemD.SalesCodeData.SupplierNo}}]</a></th>
                  <th class="Dorderth4">{{itemD.UnitPrice}}</th>
                  <th class="Dorderth5">{{itemD.Qty}}</th>
                  <th class="Dorderth6">{{itemD.DiscountRate}}</th>
                  <th class="Dorderth7">{{itemD.OrderValue}}</th>
                  <th class="Dorderth8"></th>
                  <th class="Dorderth9">{{itemD.OrderDate}}<br/>{{itemD.Ordermember}}</th>
                </tr>
              </table>
            </div>
          </div>
           <div class="col-md-1 mb-4"></div>
        </div>
        <div class="row" style="height: 500px">
          <div class="col-md-3 mb-4"></div>

          <div class="col-md-3 mb-4"></div>

          <div class="col-md-3 mb-4" style="top: 54px"></div>
        </div>
      </form>
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
      loadin: true,
      loadinD: false,
      OrderList: [],
      OrderDetail: [],
    };
  },
  methods: {
      showDetail: function(index){
           this.loadinD = true;
          axios
            .get("/api/search/OrderDetail/" + this.OrderList[index].QuotNo)
            .then((response) => {
                console.log(response.data);
                this.OrderDetail = response.data;
                this.loadinD = false; 
            });
      },

  },
  props: {
    msg: String,
  },
  beforeCreate() {
    axios
      .get("/api/search/Order/" + this.$route.params.CNO)
      .then((response) => {
        console.log(response);
        this.OrderList = response.data[0];
        this.loadin = false;
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
 position:sticky;
 top:0;
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
