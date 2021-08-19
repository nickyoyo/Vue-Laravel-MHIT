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
               <select v-model="addresschoose" :hidden="stateA==1"> 
                <option
                  v-for="item in data" :value="item" :key="item"
                >
                    {{ item.縣市 }}-{{ item.區鄉鎮市 }}-{{ item.街路}}
                </option>
              </select>
        <button  @click.prevent="senda" class="btn" :hidden="stateA==1">送出</button>
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
               <select v-model="addresschoose" :hidden="stateA==1"> 
                <option
                  v-for="item in data" :value="item" :key="item"
                >
                    {{ item.縣市 }}-{{ item.區鄉鎮市 }}-{{ item.街路}}
                </option>
              </select>
        <button  @click.prevent="sendb" class="btn" :hidden="stateA==1">送出</button>
      </div>
      </div>
    </div>
  </div>
</div>
<div class="container text-center" style="position:relative;top:100px;">
            <h1>表格到底新增功能</h1>

<div class="container text-center" style="overflow-y:scroll;height:300px;width:800px">   
    <table class="container">
      <tr>
        <th>NO</th>
        <th>sss</th>
        <th>ddd</th>
      </tr>
        <tr   v-for="(item,index) in addressC"
                  :value="item"
                  :key="index">
            <td>{{index+1}}</td>
            <td><input @click="Arraych(index)" type="text" id="sss" name="sss" class="form-control" style="width: 200px;display:inline" v-model="item.a"/></td>
            <td><input @keydown.tab="addArray()" type="text" name="ddd" class="form-control" style="width: 200px;display:inline" v-model="item.b"/></td>
        </tr> 
    </table>
</div>
</div> 
   <button  @click.prevent="addArray" class="btn">ADD</button>
</template>

<script>
  const axios = require("axios");
export default {
  name: "BVTest",
  data() {
    return {
      addressC:[
          {a:"",b:"",index:"0"}
      ],
      street:[{value:""}],
      stateA:1,
      data:[],
      arrayCount:[],
      addresschoose:[],
      index:-1,
    };
  },
  methods: {
    addressF:function(){
        var elem=document.getElementsByName('sss');
                  alert(elem.length);
    },
    Arraych: function(index){
      console.log(index);
        this.index = index;
    },
    senda: function () {
       this.addressC[this.index].a = this.addresschoose.縣市+this.addresschoose.區鄉鎮市+this.addresschoose.街路;
        this.street[0].value="";
        this.stateA=1;
       $("#ooo").modal('toggle');
    },
     sendb: function () {
       this.addressC[this.index].b = this.addresschoose.縣市+this.addresschoose.區鄉鎮市;+this.addresschoose.街路;
        this.street[0].value="";
        this.stateA=1;
       $("#XXX").modal('toggle');
    },
    addArray() {
        this.street[0].value="";
        var arr =  {a:"",b:"",index:this.addressC.length}
        this.addressC.push(arr);
    },
    getdata: function(){
           axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
          this.stateA=2;
    },
},      
  mounted(){
        axios
          .get("http://127.0.0.1:8000/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
    },
};
</script>
