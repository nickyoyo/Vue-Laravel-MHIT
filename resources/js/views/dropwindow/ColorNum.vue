<template>
      <div class="modal-dialog modal-lg" >
        <div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close"  @click="close()">
          <span>&times;</span>
				</button>
			</div>
				<div class="modal-body" >
          <h2>
            <label class="font-weight-bold" style="color: #ff5151"
              >色號列表</label
            ></h2>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         色號名稱&nbsp;
          <input
                type="text"
                style="height: 30px; width: 100px;display:inline;vertical-align: middle;font-size:18px;"
                onkeyup="this.value=this.value.replace(/\s+/g,'')"
                v-model="ColorSelectNum"     
              />&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" @click="ColorSelectM()" style="height: 30px; width: 50px;font-size:15px;display:inline;vertical-align: middle;">查詢</button>
             <br />  <br />
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
                  <th class="Corder1">選擇</th>
                  <th class="Corder2">廠商</th>
                  <th class="Corder3">色號</th>
                  <th class="Corder4">內容描述</th>
                </tr>
              </thead>
              <tr     
               v-for="(item,index) in CTDcolornum" 
                :value="item"
                :key="index"
                style="border: 1px black solid;"
              >
                  <th class="Corder1" ><button  @click="GetColor(index)">選擇</button></th>
                  <th class="Corder2">{{item.Reserve4}}</th>
                  <th class="Corder3">{{item.codeindex}}</th>
                  <th class="Corder4">{{item.codeDesc}}</th>
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
  name: "ColorNum",
  props:["PartNo","ColorSelectNum"],
  components: { 
    loader,
   },
  data: function () {
    return {
        CTDcolornum:[],
        ColorSelectNum:this.ColorSelectNum,
        loadin:0,
    };
  },
  methods:{
    close:function () {
        this.$emit("closeColor");
    },
     GetColor: function (index) {
       console.log(this.CTDcolornum[index])
        this.$emit("getColor", this.CTDcolornum[index]);
    },
    ColorSelectM:function () {
      if(this.ColorSelectNum==""){this.ColorSelectNum='X'};    
      this.loadin=1;
       axios
        .get("/api/search/ColorNo/"+ this.ColorSelectNum + "&&" + this.PartNo)
        .then((response) => {
          console.log(response.data);        
            this.CTDcolornum = response.data;
            this.loadin=0;
          });  
    },
  },
  mounted(){
       axios
        .get("/api/search/ColorNo/X&&" + this.PartNo)
        .then((response) => {
          console.log(response.data);        
            this.CTDcolornum = response.data;
          });
  },
};
</script>

<style>
.Corder1 {
  width: 80px;
  text-align: center;
}
.Corder2 {
  width: 100px;
  text-align: center;
  border: 1px black solid;
}
.Corder3 {
  width: 100px;
  text-align: center;
}
.Corder4 {
  width: 500px;
  text-align: center;
  border: 1px black solid;
}

</style>