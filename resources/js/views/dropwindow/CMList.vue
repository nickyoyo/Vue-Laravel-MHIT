<template>
      <div class="modal-dialog modal-xl" >
        <div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
				</button>
			</div>
				<div class="modal-body" >
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >客戶列表</label
            >
          </h2>
          <div
            style="
              overflow-y: scroll;
              height: 400px;
              border: 1px black solid;
            "
          >
            <table style="border: 1px black solid;">
              <thead>
                <tr style="border: 1px black solid">
                  <th class="order1">選擇</th>
                  <th class="order2">客戶編號</th>
                  <th class="order3">客戶名稱</th>
                  <th class="order4">電話</th>
                  <th class="order5">地址Address</th>
                  <th class="order6">建立日期</th>
                  <th class="order7">建立者</th>
                </tr>
              </thead>
              <tr     
               v-for="(item,index) in CMdata" 
                :value="item"
                :key="index"
                style="border: 1px black solid;"
              >
                  <th class="order1" ><button  @click="GetCustNo(index)">選擇</button></th>
                  <th class="order2">{{item.CustNo}}</th>
                  <th class="order3">{{item.CustSname}}</th>
                  <th class="order4">{{item.Mobil}}</th>
                  <th class="order5">{{item.CusAddress}}</th>
                  <th class="order6">{{item.DataCreate}}</th>
                  <th class="order7">{{item.UserId.EMME}}</th>
              </tr>
            </table>
          </div>
        </div>
        </div>
      </div>
</template>

<script>
const axios = require("axios");
export default {
  name: "CMList",
  data: function () {
    return {
        CMdata:[],
    };
  },
  methods:{
     GetCustNo: function (index) {
        this.$emit("getCustNo", this.CMdata[index].CustNo);
    }
  },
  mounted(){
       axios
        .get("/api/search/CMAll")
        .then((response) => {
          console.log(response.data);        
            this.CMdata = response.data;
          });
  },
};
</script>

<style>
.order1 {
  width: 80px;
  text-align: center;
}
.order2 {
  width: 130px;
  text-align: center;
  border: 1px black solid;
}
.order3 {
  width: 100px;
  text-align: center;
}
.order4 {
  width: 130px;
  text-align: center;
  border: 1px black solid;
}
.order5 {
  width: 390px;
  text-align: center;
  border: 1px black solid;
}
.order6 {
  width: 130px;
  text-align: center;
  border: 1px black solid;
}
.order7 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}
</style>