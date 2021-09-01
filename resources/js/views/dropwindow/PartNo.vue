<template>


      <div class="modal-dialog modal-xl" v-show="state==0">
        <div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				</button>
			</div>
				<div class="modal-body" >
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >料號列表</label
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
                  <th class="Porder1">選擇</th>
                  <th class="Porder2">色號</th>
                  <th class="Porder3">料號</th>
                  <th class="Porder4">品名</th>
                  <th class="Porder4">廠商</th>
                </tr>
              </thead>
              <tr     
               v-for="(item,index) in CTDcolornum" 
                :value="item"
                :key="index"
                style="border: 1px black solid;"
              >
                  <th class="Porder1" ><button  @click="GetCustNo(index)">選擇</button></th>
                  <th class="Porder2">{{item.Reserve4}}</th>
                  <th class="Porder3">{{item.codeindex}}</th>
                  <th class="Porder4">{{item.codeDesc}}</th>
                  <th class="Porder5">{{item.codeDesc}}</th>
              </tr>
            </table>
          </div>
        </div>
        </div>
      </div>

       <div class="modal-dialog modal-xl" v-show="state==1">
        <div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				</button>
			</div>
				<div class="modal-body" >
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >料號列表</label
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
                  <th class="PPorder1">選擇</th>
                  <th class="PPorder2">料號</th>
                  <th class="PPorder3">廠商</th>
                  <th class="PPorder4">品名</th>
                  <th class="PPorder4">售價</th>
                </tr>
              </thead>
              <tr     
               v-for="(item,index) in CTDcolornum" 
                :value="item"
                :key="index"
                style="border: 1px black solid;"
              >
                  <th class="PPorder1" ><button  @click="GetCustNo(index)">選擇</button></th>
                  <th class="PPorder2">{{item.Reserve4}}</th>
                  <th class="PPorder3">{{item.codeindex}}</th>
                  <th class="PPorder4">{{item.codeDesc}}</th>
                  <th class="PPorder5">{{item.codeDesc}}</th>
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
  name: "ColorNum",
  data: function () {
    return {
        PartNoData:[],
        state:-1,
    };
  },
  methods:{
     GetCustNo: function (index) {
        this.$emit("getCustNo", this.CTDcolornum[index].codeindex);
    }
  },
  mounted(){
       axios
        .get("/api/search/PartNo/SF002&&FC")
        .then((response) => {
          console.log(response.data);        
            this.PartNoData = response.data[0];
            this.state = response.data[1];
          });
  },
};
</script>

<style>
.Porder1 {
  width: 80px;
  text-align: center;
}
.Porder2 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}
.Porder3 {
  width: 150px;
  text-align: center;
}
.Porder4 {
  width: 500px;
  text-align: center;
  border: 1px black solid;
}
.Porder5 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}

.PPorder1 {
  width: 80px;
  text-align: center;
}
.PPorder2 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}
.PPorder3 {
  width: 150px;
  text-align: center;
}
.PPorder4 {
  width: 500px;
  text-align: center;
  border: 1px black solid;
}
.PPorder5 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}

</style>