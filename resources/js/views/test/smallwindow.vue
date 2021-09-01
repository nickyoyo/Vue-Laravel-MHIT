<template>
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
            /><button  @click.prevent="searchdata" style="display:inline" class="btn">查詢</button><br>
               <select v-model="addresschoose" :hidden="state==1"> 
                <option
                  v-for="item in data" :value="item" :key="item"
                >
                    {{ item.縣市 }}-{{ item.區鄉鎮市 }}-{{ item.街路}}
                </option>
              </select>
        <button  @click.prevent="send" class="btn" :hidden="state==1">送出</button>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- 使用按鈕開啟  data-target-->
<input type="text" class="form-control" style="width: 200px;display:inline" v-model="addressC" readonly/>
<input type="text" class="form-control" style="width: 200px;display:inline" v-model="addressS"/>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ooo">YO</button>
</template>

<script>

  const axios = require("axios");
export default {
  name: "smallwindow",
  data() {
    return {
      addresschoose:[],
      addressC:[],
      addressS:[],
      zip:[],
      data:[],
      street:[{value:""}],
      state: 1
    };
  },
  methods: {
    send: function () {
       this.addressC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.addressS = this.addresschoose.街路;
         axios
          .get("/api/search/zip/"+this.addressC)
          .then((response) => {
            console.log(response);
            this.zip = response.data;
          });
    },
    searchdata: function(){
       this.state=2;
           axios
          .get("/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
    },
  },
};
</script>
