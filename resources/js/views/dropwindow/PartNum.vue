<template>
      <div class="modal-dialog modal-xl">
      <div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close"  @click="close()">
                    <span>&times;</span>
				</button>
			</div>
				<div class="modal-body" >
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >料號列表</label
            >
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input
                type="text"
                style="height: 30px; width: 100px;display:inline;vertical-align: middle;font-size:18px;"
                onkeyup="value=value.replace(/[\W]/g,'') " 
                onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"
                v-model="PartSelect"     
              />&nbsp;
            <button type="button" @click="PartSelectM()" style="height: 30px; width: 50px;font-size:15px;display:inline;vertical-align: middle;">查詢</button>
             </h2>
          <div
            style="
              overflow-y: scroll;
              height: 400px;
              border: 1px black solid;
            "
          >
          <a v-if="loadin==1">
                <loader></loader>
          </a>
          <a v-else>
            <table style="border: 1px black solid;">
              <thead>
                <tr style="border: 1px black solid">
                  <th class="PPorder1">選擇</th>
                  <th class="PPorder2">料號</th>
                  <th class="PPorder3">廠商</th>
                  <th class="PPorder4">品名</th>
                  <th class="PPorder5">售價</th>
                </tr>
              </thead>
              <tr     
              v-for="(item,index) in PartNoData" 
                :value="item"
                :key="index"
                style="border: 1px black solid;"
              >
                  <th class="PPorder1" ><button  @click="GetPart(index)">選擇</button></th>
                  <th class="PPorder2">{{item.SKU}}</th>
                  <th class="PPorder3">{{item.SupplierNo.SuppNo}}</th>
                  <th class="PPorder4">{{item.Description}}</th>
                  <th class="PPorder5">{{item.FullPrice}}</th>
              </tr> 
            </table>
             </a>
          </div>
        </div>
        </div>
      </div>
</template>

<script>
const axios = require("axios");
import loader from "../test/Loader.vue";
export default {
  name: "PartNum",
   components: { 
    loader,
   },
  data: function () {
    return {
        PartNoData:[],
        PartSelect:"",
        loadin:0,
    };
  },
  methods:{
    close:function () {
        this.$emit("closePart");
    },
     GetPart: function (index) {
       console.log(this.PartNoData[index])
        this.$emit("getPart", this.PartNoData[index]);
    },
       PartSelectM:function () {
           this.loadin=1;
            axios
            .get("/api/search/PartNo/"+ this.PartSelect)
            .then((response) => {
            console.log(response.data);        
                this.PartNoData = response.data;
                this.PartSelect = "";
                 this.loadin=0;
            });  
    },
  },
  mounted(){
       axios
        .get("/api/search/PartNo/ANK01")
        .then((response) => {
          console.log(response.data);        
            this.PartNoData = response.data;
          });
  },
};
</script>

<style>

.PPorder1 {
  width: 80px;
  text-align: center;
}
.PPorder2 {
  width: 200px;
  text-align: center;
  border: 1px black solid;
}
.PPorder3 {
  width: 130px;
  text-align: center;
}
.PPorder4 {
  width: 500px;
  text-align: center;
  border: 1px black solid;
}
.PPorder5 {
  width: 150px;
  text-align: center;
  border: 1px black solid;
}

</style>