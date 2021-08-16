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
            /><button  @click.prevent="getdata" style="display:inline" class="btn">查詢</button><br>
               <select v-model="addresschoose"> 
                <option
                  v-for="item in data" :value="item" :key="item"
                >
                    {{ item.縣市 }}-{{ item.區鄉鎮市 }}-{{ item.街路}}
                </option>
              </select>
        <button  @click.prevent="send" class="btn">送出</button>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- 使用按鈕開啟  data-target-->
<input type="text" class="form-control" style="width: 200px;display:inline" v-model="addressC" readonly/>
<input type="text" class="form-control" style="width: 200px;display:inline" v-model="addressS"/>
<button @click.prevent="getdata" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ooo">YO</button>
</template>

<script>
  const axios = require("axios");
export default {
  name: "Login",
  data() {
    return {
      addresschoose:[],
      addressC:[],
      addressS:[],
      zip:[],
      data:[],
      street:[{value:"empty"}],
    };
  },
  methods: {
    send: function () {
       this.addressC = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.addressS = this.addresschoose.街路;
         axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.addressC)
          .then((response) => {
            console.log(response);
            this.zip = response.data;
          });
    },
     close: function () {
    
    },
    getdata: function(){
           axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
    },
    datasearch: function(){
           axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
    }
  },
};
</script>
