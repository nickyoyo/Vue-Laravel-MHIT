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

<div id="XXX" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
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

<div class="container text-center" style="padding: 50px">
            <h1>表格到底新增功能</h1>     
    <table class="PDtableborder">
      <tr>
        <th>DDD</th>
        <th>SSS</th>
      </tr>
        <tr   v-for="item in addressC"
                  :value="item.a"
                  :key="item.a">
            <td><input type="text" id="sss" class="form-control" style="width: 200px;display:inline" v-model="item.a"/></td>
            <td><input type="text" id="ddd" class="form-control" style="width: 200px;display:inline" v-model="item.b"/></td>
        </tr>
    </table>
</div>

   <button  @click.prevent="addArray" class="btn">ADD</button>
</template>

<script>
  const axios = require("axios");
export default {
  name: "smallwindow",
  data() {
    return {
      addressC:[
          {a:"1",b:"2"}
      ],
      addressS:[],
      street:[{value:"empty"}],
    };
  },
  methods: {
    send: function () {
       this.item.a = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;
       this.addressS = this.addresschoose.街路;
         axios
    },
    addArray: function () {
        var arr =  {a:"1",b:"2"}
        this.addressC.push(arr);
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
  mounted() {
        axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
        
       document.getElementById('sss').addEventListener('keydown',function(e){
            if (e.shiftKey) {
                // this.getdata();
                  $("#ooo").modal('show');              
            }
                },false);
        document.getElementById('ddd').addEventListener('keydown',function(e){
            if (e.shiftKey) {
                // this.getdata();
                  $("#XXX").modal('show');              
            }
                },false);
        },
};
 

</script>
