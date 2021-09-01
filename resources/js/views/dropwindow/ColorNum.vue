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
        CTDcolornum:[],
    };
  },
  methods:{
    close:function () {
        this.$emit("closeColor");
    },
     GetColor: function (index) {
       console.log(this.CTDcolornum[index].codeindex);
        this.$emit("getColor", this.CTDcolornum[index].codeindex);
    }
  },
  mounted(){
       axios
        .get("/api/search/CTD/門板色")
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