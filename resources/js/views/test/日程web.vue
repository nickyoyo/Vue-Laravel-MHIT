<template>

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
            <td><input @keydown.shift="OpenAddressS()" @click="Arraych(index)" type="text" class="form-control" style="width: 200px;display:inline" v-model="item.a"/></td>
            <td><input @keydown.shift="OpenAddressD()" @keydown.tab.exact="addArray(index)" @click="Arraych(index)" type="text" class="form-control" style="width: 200px;display:inline" v-model="item.b"/></td>
            <td><input @keydown.tab="addArray(index)" type="text" class="form-control" style="width: 200px;display:inline"/></td>
        </tr> 
    </table>
</div>
</div> 
</template>

<script>
  const axios = require("axios");
export default {
  name: "日程web",
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
    OpenAddressS:function(){
         $("#ooo").modal('show');              
    },
     OpenAddressD:function(){
         $("#XXX").modal('show');              
    },
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
    addArray(index) {
        this.street[0].value="";
        this.index = index+1;
         console.log(index);
        console.log(this.addressC.length);
        if(index==this.addressC.length-1){
            var arr =  {a:"",b:"",index:this.addressC.length}
            this.addressC.push(arr);
        }
    },
    getdata: function(){
           axios
          .get("/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
          this.stateA=2;
    },
},      
  mounted(){
        axios
          .get("/api/search/zip/"+this.street[0].value)
          .then((response) => {
            console.log(response.data);
            this.data = response.data;
          });
    },
};
</script>
