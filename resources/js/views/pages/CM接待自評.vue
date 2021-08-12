<template>
    <a v-if="choose">
      <CMcreate @my-event="saveT"></CMcreate>
    </a>
    <a v-else>
             <h1 style="position:relative;left:300px;">接待自評</h1>         

                  <form action="/" >
         
                        <table class="AF1tableborder">
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">迎&nbsp;&nbsp;&nbsp;&nbsp;賓</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF1[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF1[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF1[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待迎賓心得</h4>
                                        <input type="textarea"  v-model="AF1[3].value" style="width:450px;height:50px;">
                            </th>
                        </tr>
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">門市展演</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF2[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF2[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF2[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待門市展演心得</h4>
                                        <input type="textarea" v-model="AF2[3].value" style="width:450px;height:50px;">
                            </th>
                        </tr>
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">案例對焦</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF3[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF3[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF3[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待案例對焦心得</h4>
                                        <input type="textarea" v-model="AF3[3].value" style="width:450px;height:50px;">
                            </th>
                        </tr>
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">服務流程</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF4[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF4[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF4[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待服務流程心得</h4>
                                        <input type="textarea" v-model="AF4[3].value" style="width:450px;height:50px;">
                            </th>
                        </tr>
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">促銷活動</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF5[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF5[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF5[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待促銷活動心得</h4>
                                        <input type="textarea" v-model="AF5[3].value" style="width:450px;height:50px;">
                            </th>
                        </tr>
                        <tr>
                            <th class="bordertopic" style="color:#FF5151; font-size:20px;">異議排除</th>
                            <th class="AF-tablecheckbox">
                                   <h4>下列核心競爭力中，本次接待我有做到</h4>
                                   &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF6[0].state">
                                    <h7>誠信</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF6[1].state">
                                    <h7>品質</h7>&nbsp;&nbsp;
                                        <input type="checkbox" v-model="AF6[2].state">
                                    <h7>效率</h7>&nbsp;&nbsp;
                            </th>
                            <th class="AF-tabletext">
                                   <h4>如果可以，簡略分享本次接待異議排除心得</h4>
                                        <input type="textarea" v-model="AF6[3].value" style="width:450px;height:50px;">
                            </th>
                         </tr>       
                </table> <br>
                <div style="width:1200px;position: relative;top:1000px;">
                    <div class="row" style="width:1200px;position: relative;left:24%;">
                            <div class="col-md-2 mb-4">
                                    <input type="checkbox" v-model="AF7[0].value">&nbsp;
                                    <h7>店長接待</h7>
                            </div>
                            <div class="col-md-2 mb-4">
                                    <input type="checkbox" v-model="AF8[0].value">&nbsp;
                                    <h7>LINE</h7>
                            </div>
                             <div class="col-md-2 mb-4">
                                    <input type="checkbox" v-model="AF9[0].value">&nbsp;
                                    <h7>GOOGLE</h7>
                            </div>
                            <div class="col-md-4 mb-4">
                                    <h7>本次接待是否取得CRF資料</h7>&nbsp;&nbsp;<br>
                                    <input type="radio" v-model="AF10[0].value" :value="true">
                                        <h7>有取得資料</h7>&nbsp;&nbsp;
                                    <input type="radio" v-model="AF10[0].value" :value="false">
                                        <h7>沒有取得資料</h7><br>  
                        </div>
                    </div>
                    <div class="row" style="width:2000px;position: relative;left:24%;">
                        <div class="col-md-4 mb-4">
                                    <h7>店長協助內容 : </h7>&nbsp;
                                        <textarea  v-model="AF7[0].memo" style="width:450px;height:50px;" /> 
                        </div>
                        <div class="col-md-1 mb-4"><br>
                    <button @click.prevent="save" type="submit">完成自評</button>
                        </div>
                             
                </div>
            </div>
        </form>
    </a>
</template>

<script>
import CMcreate from "./CMcreate";
  const axios = require("axios");
export default {
  components: { CMcreate },
  name: 'CM接待自評',
  data () {
    return {
        AF1: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF2: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF3: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF4: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF5: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF6: [{ type: "A", value: 4,state: false},{ type: "B", value: 2,state: false},{ type: "C", value: 1,state: false},{ type: "text", value: ""}],
        AF7: [{ memo: "", value: false}],
        AF8: [{ type: "D", value: false}],
        AF9: [{ type: "D", value: false}],
        AF10: [{ type: "D", value: false}], 
        choose: false,
    }
  },
   methods: {
    save: function () {
        if(this.AF10[0]['value']==false){
          axios.post("http://127.0.0.1:8000/api/Create/self-evaluation",{
             AF1: this.AF1,
             AF2: this.AF2,
             AF3: this.AF3,
             AF4: this.AF4,
             AF5: this.AF5,
             AF6: this.AF6,
             AF7: this.AF7,
             AF8: this.AF8,
             AF9: this.AF9,
             AF10: this.AF10,
          })
      .then(function (response) { 
          console.log(response);
      })
      .catch(function (response) {
          console.log(response);
      });
       this.$router.push({ name: 'CMsendSearch' })
    }
    else{
        this.choose = true;
    } 
    },
     saveT: function () {
          axios.post("http://127.0.0.1:8000/api/Create/self-evaluation",{
             AF1: this.AF1,
             AF2: this.AF2,
             AF3: this.AF3,
             AF4: this.AF4,
             AF5: this.AF5,
             AF6: this.AF6,
             AF7: this.AF7,
             AF8: this.AF8,
             AF9: this.AF9,
             AF10: this.AF10,
          })
      .then(function (response) { 
          console.log(response);
      })
      .catch(function (response) {
          console.log(response);
      });
       this.$router.push({ name: 'CMsendSearch' })
    },   
  },
}
</script>


<style>
thead tr th {
                position:sticky;
                top:0;
                background-color: #ADADAD;
            }
            .topic{
                position: relative;
                margin-top:10px;
                margin-left:450px;
            }
            .AF2topic{
                position: absolute;
                left:34%;
            }
            .login{
                position: relative;
                color:#000000;
            }
            .tableborder{
                width:950px;
                margin: 0px auto;
            }
            .AF1tableborder{
                position:absolute;
                left:300px;
                height: 1000px;
                width:1100px;
                margin: 0px auto;
            }
            .PDtableborder{
                width:900px;
                margin: 0px auto;
            }
            .AF2tableborder{
                width:300px;
                height:200px;
                margin: 0px auto;
                border:1px solid black;
                overflow-y: auto;/*設定卷軸 auto 是有超過我的高度的時候才會出現卷軸*/
                display: block;
            }
            .bordertopic{
                width:10%;
                font-size:20px;
                margin: 0px auto;
                text-align:center;
                font-weight:solid;
                border-top:2px solid black;
                border-bottom:2px solid black;
            }
            .PDtopic{
                width:10%;
                font-size:20px;
                margin: 0px auto;
                text-align:center;
                font-weight:solid;
                border:1px solid black;
            }
            .AF-checkbox{
                width:20%;
                height:50px;
                margin: 0px auto;
                border-top:2px solid black;
                border-bottom:2px solid black;
            }
            .AF-tablecheckbox{
                width:30%;
                height:100px;
                margin: 0px auto;
                padding: 0px 0px 0px 0px;
                border-top:2px solid black;
                border-bottom:2px solid black;
                border-collapse:collapse;
            }
            .AF-tabletext{
                width:40%;
                height:100px;
                margin: 0px auto;
                border-top:2px solid black;
                border-bottom:2px solid black;
                border-collapse:collapse;
            }
            .AF-space{
                width:1%;
                border-top:2px solid black;
                border-bottom:2px solid black;
            }
            .tablecheckbox{
                width:350px;
                height:100px;
                margin: 0px auto;
                padding: 0px 0px 0px 0px;
                border-top:2px solid black;
                border-bottom:2px solid black;
                border-collapse:collapse;
            }
            .AF11tableborder-250wid{
                font-size:10px;
                border:0.5px black solid;
                width:250px;
            }
            .tableborder-samll{
                width:100px;
                border:0.5px black solid;
                margin-left: 1em;
            }
            .text-a-center{
                text-align:center;
            }
            .textw3 {
                    width:3%;
                    padding:10px 0px;
                    color:#555;
                    background-color:#fff;
                    border:1px solid black;
                    font-size:16px;
                    font-weight:solid;
            }
            .textw5 {
                    width:5%;
                    padding:10px 0px;
                    color:#555;
                    background-color:#fff;
                    border:1px solid black;
                    font-size:16px;
                    font-weight:solid;
            }
            .textw5px {
                    width:5px;
                    padding:10px 0px;
                    color:#555;
                    background-color:#fff;
                    border:1px solid black;
                    font-size:16px;
                    font-weight:solid;
            }
            .textw10 {
                    width:50px;
                    padding:10px 0px;
                    color:#555;
                    background-color:#fff;
                    border:1px solid black;
                    font-size:16px;
                    font-weight:solid;
            }
            .textw12 {
                    width:12%;
                    padding:10px 0px;
                    color:#555;
                    background-color:#fff;
                    border:1px solid black;
                    font-size:16px;
                    font-weight:solid;
            }
            .textw20 {
                width:20%;
                padding:10px 0px;
                color:#555;
                background-color:#fff;
                border:1px solid black;
                font-size:16px;
                font-weight:solid;
            }
            .textw200px {
                width:200px;
                color:#555;
                background-color:#fff;
                border:1px solid black;
                font-size:16px;
                font-weight:solid;
            }
            .textw30 {
                width:30%;
                padding:10px 0px;
                color:#555;
                background-color:#fff;
                border:1px solid black;
                font-size:16px;
                font-weight:solid;
            }
            .textw50 {
                width:50%;
                padding:10px 0px;
                color:#555;
                background-color:#fff;
                border:1px solid black;
                font-size:16px;
                font-weight:solid;
            }
            
            ul form {
                display: inline;
            }
            .buttonback {
                width:90px;
                height:25px;
            }
</style>
