<template>
    <div id="loading" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
      <div class="modal-dialog modal-sm" >
            <loader></loader>
      </div>
  </div>

 <div id="ColorNum" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
     <ColorNum @getColor="setColor" @closeColor="closeColor" v-bind:PartNo="SuppNo" v-bind:ColorSelectNum="ColorSelectNum" :key="refnew"></ColorNum>
  </div>

  <div id="PartNum" class="modal inmodal fade"  tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
     <PartNum @getPart="setPart" @closePart="closePart" :key="refnew" v-bind:PartSelect="PartSelect"></PartNum>
  </div>

    <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-weight-bold" style="position:relative;left:45%">編修訂單</h2>
				<button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
				</button>
            </div>
            <div class="modal-body">

                <div class="row" style="height: 150px">
                        <div style="width:50px;"></div>
                        <div style="width:200px;">
                            <table class="container " style="padding:10px;text-align: right">
                                <tr><td style="height: 40px;">
                                        客戶編號&nbsp;<input type="text" style="height: 30px; width: 120px;" v-model="OrderData[0].CusNo" readonly />
                                    </td></tr>  
                                        <tr><td style="height:40px;">
                                            訂單編號&nbsp;<input type="text" style="height: 30px; width: 120px;" v-model="OrderData[0].QuotNo" readonly />
                                        </td></tr>  
                            </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:200px;">
                            <table class="container " style="padding:10px;text-align: right">
                                <tr><td style="height: 40px;">
                                        專案顧問&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.EMID" readonly />
                                        </td></tr>  
                                        <tr><td style="height: 40px;">
                                            中文名&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.EMME" readonly />
                                        </td></tr>  
                                <tr><td style="height: 40px;">
                                            門市別&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderDataEM.DVID" readonly />
                                        </td></tr>
                            </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:200px;">
                        <table class="container " style="padding:10px;text-align: right">
                            <tr><td style="height: 40px;">
                                    訂單檔期&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].PromotionPeriod" readonly />
                                </td></tr>  
                            <tr><td style="height: 40px;">
                                    簽約日期&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].OrderDate" readonly />
                                    </td></tr>
                            <tr><td style="height: 40px;">
                                    <button>預計安裝</button>&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].RequireDate" readonly />
                                </td></tr>                    
                        </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:200px;">
                        <table class="container " style="padding:10px;text-align: right">
                            <tr><td style="height: 40px;">
                                        完款日期&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].ClearDate" readonly />
                                    </td></tr>
                            <tr><td style="height: 40px;">
                                    <button>預計完款</button>&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].ExpireDate" readonly />
                                    </td></tr>
                            <tr><td style="height: 40px;">
                                        確出日期&nbsp;<input type="text" style="height: 30px; width: 90px;" v-model="OrderData[0].AppDate" readonly />
                                    </td></tr>          
                        </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:200px;">
                            <table class="container " style="padding:10px;text-align: right">
                                <tr><td style="height: 40px;">
                                        訂單總額&nbsp;<input type="text" style="height: 30px; width: 90px; text-align: right" v-model="OrderDataARM1.OrderValue" readonly />
                                        </td></tr>
                                <tr><td style="height: 40px;">
                                            <button>額外施工</button>&nbsp;<input type="text" style="height: 30px; width: 90px;text-align: right" v-model="OrderDataARM1.exwork" readonly />
                                        </td></tr>
                                <tr><td style="height: 40px;">
                                            訂單餘額&nbsp;<input type="text" style="height: 30px; width: 90px;text-align: right" v-model="OrderDataARM1.HelpPayValue" readonly />
                                        </td></tr>
                            </table>
                        </div>
                </div>

                <div class="row" style="height: 200px">
                        <div style="width:300px;">
                            <table class="container " style="padding:10px;text-align: right">
                                <tr><td>
                                分類
                                    <input
                                        type="text"
                                        style="height: 40px; width: 50px; text-align: center"
                                        v-model="OrderData[0].OrderType"
                                        readonly
                                    />-
                                        <input
                                        type="text"
                                        style="height: 40px; width: 120px"
                                        v-model="OrderDataCTDtype"
                                        readonly
                                    />
                                </td></tr>  
                            </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:400px;">
                            <table class="container " style="padding:10px;text-align: left">
                                <tr><td>
                                    地址
                                    <br />
                                    <input
                                        type="text"
                                        style="height: 30px; width: 50px;"
                                        v-model="OrderData[0].ZIP"
                                        readonly
                                    />
                                    </td><td>
                                <textarea
                                    style="
                                    width: 300px;
                                    height: 80px;
                                    display: inline;
                                    vertical-align: middle;"
                                    v-model="OrderData[0].addr"
                                    readonly
                                ></textarea>
                                </td></tr>

                                <tr><br /><td></td><td></td></tr>

                                <tr><td colspan="2">
                                  <label class="font-weight-bold"
                                    >Memo&nbsp;
                                    <textarea
                                    style="
                                        width: 300px;
                                        height: 80px;
                                        display: inline;
                                        vertical-align: middle;"
                                        v-model="OrderDataMemo"
                                    readonly
                                    ></textarea>
                                    </label>
                                    </td></tr>
                            </table>
                        </div>
                        <div style="width:100px;"></div>

                        <div style="width:600px;">
                            訂單相關資訊
                             <textarea
                                    style="
                                    width: 500px;
                                    height: 180px;
                                    display: inline;
                                    vertical-align: middle;"
                                    readonly
                            ></textarea>
                        </div>

                </div>

                <div class="row" style="height: 420px">
                        <div style="width:50px;"></div>
                        <div class="col-md-11 mb-4">
                        <h2>
                            <label class="font-weight-bold" style="color: #ff5151"
                            >報價訂單明細</label
                            >
                        </h2>
                        <div
                            style="
                            overflow-y: scroll;
                            height: 350px;
                            width: 1630px;
                            border: 1px black solid;
                            "
                        >
                            <table style="border: 1px black solid; width: 1580px">
                            <thead>
                                <tr style="border: 1px black solid">
                                <th class="Morderth1">項次</th>
                                <th class="Morderth3">料號</th>
                                <th class="Morderth2">色號</th>
                                <th class="Morderth4">定價</th>
                                <th class="Morderth5">訂單量</th>
                                <th class="Morderth6">折扣率</th>
                                <th class="Morderth7">金額</th>
                                <th class="Morderth8">是否有採購單</th>
                                <th class="Morderth9">備註</th>
                                </tr>
                            </thead>
                            <tr
                                v-for="(itemD, index) in OrderDetailitem"
                                :value="itemD"
                                :key="index"
                                style="border: 1px black solid"
                                :hidden="show == 1"
                            >
                                <th class="Morderth1">{{ index + 1 }}</th>
                                <th class="Morderth3">
                                  <input
                                        name='Part[]'
                                        type="text"
                                        style="height: 30px; width: 250px;"
                                        onkeyup="value=value.replace(/\s/g,'')" 
                                        onbeforepaste="value=value.replace(/(^\s*)|(\s*$)/g, '')"
                                        v-on:change="SetTypePart(index)"
                                        v-model="itemD.SalesCode"
                                        maxlength="30"
                                        @keydown.enter="getPartNum(index)"
                                        @click="getindex(index)"
                                    />    
                                    <br /><a style="color: blue"
                                    >{{ itemD.SalesCodeData.Description }}[{{
                                    itemD.SalesCodeData.SupplierNo.SuppNo
                                    }}]</a
                                >
                                </th>
                                <th class="Morderth2">  
                                    <input
                                        type="text"
                                        name='Color[]'
                                        style="height: 30px; width: 100px;"
                                        onkeyup="this.value=this.value.replace(/\s+/g,'')"
                                        onbeforepaste="value=value.replace(/(^\s*)|(\s*$)/g, '')"
                                        v-model="itemD.Ragne"
                                        maxlength="20"
                                        @keydown.enter="getColorNum(index)"
                                        v-on:change="SetTypeColor(index)"
                                        @click="getindex(index)"
                                        @keydown.tab.exact="TypeColorTab(index)"
                                        :readonly="itemD.SalesCodeData.SupplierNo.LastTrans==''"                   
                                    /><br /><a style="color: green">
                                    {{ itemD.RangeName}}
                                    </a></th>
                                <th class="Morderth4">{{ itemD.UnitPrice }}</th>
                                <th class="Morderth5">
                                     <input
                                        name='Qty[]'
                                        type="number"
                                        style="height: 30px; width: 70px;"
                                        min="0"
                                        v-model="itemD.Qty"
                                        v-on:change="SetQty(index)"
                                        @keydown.tab.exact="nextcol(index)"
                                        @click="getindex(index)"
                                    />    
                                </th>
                                <th class="Morderth6">{{ itemD.DiscountRate }}</th>
                                <th class="Morderth7">{{ itemD.OrderValue }}</th>
                                <th class="Morderth8"><a style="color:red" :hidden="itemD.poCheck==0">有採購單</a></th>
                                <th class="Morderth9"></th>
                            </tr>
                            </table>
                        </div>
                        </div>
                        <div class="col-md-1 mb-4"></div>
                </div>  

                <div class="modal-footer" style="height:50px">
                    <button type="button" class="close" style="padding:10px;border: 2px black solid" data-dismiss="modal" @click="save()">送出儲存</button>
                    <button type="button" class="close" style="padding:10px;border: 2px black solid" data-dismiss="modal" @click="close()">不儲存離開</button>
                </div>
            </div>
        </div>
</template>

<script>
import ColorNum from "../dropwindow/ColorNum.vue";
import PartNum from "../dropwindow/PartNum.vue";
import loader from "../test/Loader.vue";
const axios = require("axios");
export default {
  name: "ModifyOrderpage",
  props:["index","QuotNo"],
   components: { 
    loader,
    ColorNum,
    PartNum,
   },
  data: function () {
    return {
       refnew:false,
       SuppNo:0,

      OrderList: [],
      OrderData: [{
          OrderType:'',
      }],
      OrderDataMemo: "",
      OrderDataCTDtype: "",
      OrderDetailitem: [],
      OrderDataFINST: [],
      OrderDataEM: [],
      OrderDataARM1:[],
      Selectorder:this.index,
      DetailIndex:"",
      OrderOrderDetailitemstorage:[],

      ColorSelectNum:"",
      PartSelect:"",
      Ragne:"",
      RangeName:"",
    };
  },
  methods:{
    closeColor:function(){
         this.refnew=false;
         $("#ColorNum").modal('hide');              
    },
    getColorNum:function(index){  
        this.DetailIndex = index;
        this.refnew=true;
        this.SuppNo = this.OrderDetailitem[index].SalesCodeData.SupplierNo.SuppNo;
        this.ColorSelectNum = this.OrderDetailitem[index].Ragne;       
         $("#ColorNum").modal('show');    
    },
    closePart:function(){
         this.refnew=false;
         $("#PartNum").modal('hide');              
    },
    getPartNum:function(index){
        this.DetailIndex = index;
        this.refnew=true;
        this.PartSelect = this.OrderDetailitem[index].SalesCodeData.SKU;       
         $("#PartNum").modal('show');       
    },
    setColor:function(val){
        this.refnew=false;
        this.OrderDetailitem[this.DetailIndex].Ragne = val.codeindex;   
        this.OrderDetailitem[this.DetailIndex].RangeName = val.codeDesc;  
         $("#ColorNum").modal('hide'); 

         axios
        .get("/api/search/ColorPrice/"+ this.OrderDetailitem[this.DetailIndex].SalesCode +"&&" + this.OrderDetailitem[this.DetailIndex].Ragne +"&&" + this.OrderData[0].QuotNo)
        .then((response) => {
          console.log(response.data);
            this.OrderDetailitem[this.DetailIndex].UnitPrice = response.data;
            this.OrderDetailitem[this.DetailIndex].Qty = 0;
            this.OrderDetailitem[this.DetailIndex].OrderValue = 0;
        });         

        this.OrderOrderDetailitemstorage[this.DetailIndex]=Object.assign({}, this.OrderDetailitem[this.DetailIndex]);
               
        document.getElementsByName('Color[]')[this.DetailIndex].select(); 
    },
    setPart:function(val){
        this.refnew=false;
        this.OrderDetailitem[this.DetailIndex].SalesCode = val.SKU;   
        this.OrderDetailitem[this.DetailIndex].SalesCodeData = val;  
        this.OrderDetailitem[this.DetailIndex].Ragne="";
        this.OrderDetailitem[this.DetailIndex].RangeName="";
         $("#PartNum").modal('hide'); 
        axios
        .get("/api/search/IMChangePriceRecord/"+ this.OrderDetailitem[this.DetailIndex].SalesCode +"&&" + this.OrderData[0].QuotNo)
        .then((response) => {
          console.log(response.data);
          if(response.data[1]==1){
            this.OrderDetailitem[this.DetailIndex].UnitPrice = response.data[0].後價;
            this.OrderDetailitem[this.DetailIndex].Qty = 0;
            this.OrderDetailitem[this.DetailIndex].OrderValue = 0;
          }
          else{
            this.OrderDetailitem[this.DetailIndex].UnitPrice = response.data[0].FullPrice;
            this.OrderDetailitem[this.DetailIndex].Qty = 0;
            this.OrderDetailitem[this.DetailIndex].OrderValue = 0;

          }
        });              
        this.OrderOrderDetailitemstorage[this.DetailIndex]=Object.assign({}, this.OrderDetailitem[this.DetailIndex]);
       
        document.getElementsByName('Part[]')[this.DetailIndex].select();        
    },
    SetQty:function(index){
        this.OrderDetailitem[index].OrderValue = this.OrderDetailitem[index].UnitPrice * this.OrderDetailitem[index].Qty;
    },
    SetTypeColor:function(index){
        this.OrderDetailitem[this.DetailIndex].Ragne = this.OrderDetailitem[this.DetailIndex].Ragne.replace(/\s*/g,"");
        axios
            .get("/api/search/ColorNoType/"+ this.OrderDetailitem[this.DetailIndex].Ragne + "&&" +  this.OrderDetailitem[index].SalesCodeData.SupplierNo.SuppNo)
            .then((response) => {
            console.log(response.data);        
                if(response.data[1] == 0){
                    this.OrderDetailitem[index].Ragne = this.OrderOrderDetailitemstorage[index].Ragne;  
                    this.OrderDetailitem[index].RangeName = this.OrderOrderDetailitemstorage[index].RangeName;
 
                }   
                else{
                    this.OrderDetailitem[index].Ragne = response.data[0].codeindex;   
                    this.OrderDetailitem[index].RangeName = response.data[0].codeDesc;
                    
                    axios
                    .get("/api/search/ColorPrice/"+ this.OrderDetailitem[index].SalesCode +"&&" + this.OrderDetailitem[index].Ragne +"&&" + this.OrderData[0].QuotNo)
                    .then((response) => {
                    console.log(response.data);
                        this.OrderDetailitem[index].UnitPrice = response.data;
                        this.OrderDetailitem[index].Qty = 0;
                        this.OrderDetailitem[index].OrderValue = 0;
                    });       

                    this.OrderOrderDetailitemstorage[index]=Object.assign({}, this.OrderDetailitem[index]);
                }
            });
    },  
    SetTypePart:function(index){
        this.OrderDetailitem[index].SalesCode = this.OrderDetailitem[index].SalesCode.replace(/\s*/g,"");
        this.PartSelect = this.OrderDetailitem[index].SalesCode;
        if(this.OrderDetailitem[index].SalesCode ==''|| this.OrderDetailitem[index].SalesCode ==' '){
              this.OrderDetailitem[index].SalesCodeData = this.OrderOrderDetailitemstorage[index].SalesCodeData;  
              this.OrderDetailitem[index].SalesCode = this.OrderOrderDetailitemstorage[index].SalesCodeData.SKU;  
        }
        else{
                axios
                .get("/api/search/PartNoType/"+ this.OrderDetailitem[index].SalesCode)
                .then((response) => {
                console.log(response.data);  
                if(response.data[1] == 0){
                    this.OrderDetailitem[index].SalesCodeData = this.OrderOrderDetailitemstorage[index].SalesCodeData;  
                    this.OrderDetailitem[index].SalesCode = this.OrderOrderDetailitemstorage[index].SalesCodeData.SKU;  
                }   
                else{
                this.OrderDetailitem[index].SalesCode = response.data[0].SKU;   
                this.OrderDetailitem[index].SalesCodeData = response.data[0];
                this.OrderDetailitem[index].Ragne="";
                this.OrderDetailitem[index].RangeName="";
                 axios
                    .get("/api/search/IMChangePriceRecord/"+ this.OrderDetailitem[index].SalesCode +"&&" + this.OrderData[0].QuotNo)
                    .then((response) => {
                    console.log(response.data);
                    if(response.data[1]==1){
                        this.OrderDetailitem[index].UnitPrice = response.data[0].後價;
                        this.OrderDetailitem[index].Qty = 0;
                        this.OrderDetailitem[index].OrderValue = 0;
                    }
                    else{
                        this.OrderDetailitem[index].UnitPrice = response.data[0].FullPrice;
                        this.OrderDetailitem[index].Qty = 0;
                        this.OrderDetailitem[index].OrderValue = 0;

                    }
                    }); 
                this.OrderOrderDetailitemstorage[index]=Object.assign({}, this.OrderDetailitem[index]); 
                }   
               
            });  
        }
    },
    getindex:function(index){
         this.DetailIndex = index;
    },
    TypeColorTab:function(index){
         this.OrderDetailitem[this.DetailIndex].Ragne = this.OrderDetailitem[this.DetailIndex].Ragne.replace(/\s*/g,"");
            axios
                .get("/api/search/ColorNoType/"+ this.OrderDetailitem[this.DetailIndex].Ragne + "&&" +  this.OrderDetailitem[index].SalesCodeData.SupplierNo.SuppNo)
                .then((response) => {
                console.log(response.data);        
                    if(response.data[1] == 0){
                        this.OrderDetailitem[index].Ragne = this.OrderOrderDetailitemstorage[index].Ragne;  
                        this.OrderDetailitem[index].RangeName = this.OrderOrderDetailitemstorage[index].RangeName;
                        document.getElementsByName('Color[]')[index].select();        
                        alert("此料號並無此色號");    
                    }   
                    else{
                        this.OrderDetailitem[index].Ragne = response.data[0].codeindex;   
                        this.OrderDetailitem[index].RangeName = response.data[0].codeDesc;  
                        this.OrderOrderDetailitemstorage[index]=Object.assign({}, this.OrderDetailitem[index]);
                    }
                });
        var colornum;
         if(this.OrderDetailitem[index].Ragne==""){
            colornum='X';
         }
         else{
            colornum=this.OrderDetailitem[index].Ragne;
         }
        axios
        .get("/api/search/OrderDetailitemCheckPC/"+ this.OrderDetailitem[index].SalesCodeData.SupplierNo.SuppNo +"&&" + colornum)
        .then((response) => {
          console.log(response.data);
            if(response.data==0){
                this.OrderDetailitem[index]=Object.assign({}, this.OrderOrderDetailitemstorage[index]); 
            }
        });  
    },
    nextcol:function(index){
            this.DetailIndex = index+1;  
    },
    close:function(){
        this.$emit("closeModify");  
    },
    save:function(){
        this.$emit("saveModify");  
    },
  },
 mounted(){
       $("#loading").modal('show');
      axios
        .get("/api/search/OrderDetailitem/S02171130103")
        .then((response) => {
          console.log(response.data);
          this.OrderDetailitem = response.data;
         $("#loading").modal('hide');
        });
     axios
        .get("/api/search/OrderDetailitem/S02171130103")
        .then((response) => {
          console.log(response.data);
          this.OrderOrderDetailitemstorage = response.data;
         $("#loading").modal('hide');
        });
      axios
        .get("/api/search/Orderdata/S02171130103")
        .then((response) => {
          console.log(response);
          this.OrderData = response.data;
           axios
            .get("/api/search/CTD/Desc/訂單類&&00")
            .then((response) => {
                console.log(response);
                this.OrderDataCTDtype = response.data.codeDesc;
            });
            axios
            .get("/api/search/CmMemo/S02171130103&&02")
            .then((response) => {
                console.log(response);
                this.OrderDataMemo = response.data.memo;
            });
            axios
            .get("/api/search/OrderFINST/S02171130103")
            .then((response) => {
                console.log(response);
                this.OrderDataFINST = response.data;
            });
            axios
            .get("/api/search/PD/03030210")
            .then((response) => {
                console.log(response);
                this.OrderDataEM = response.data;
            });
            axios
            .get("/api/search/OrderARM1/S02171130103")
            .then((response) => {
                console.log(response);
                this.OrderDataARM1 = response.data;
                 $("#loading").modal('hide');
            });
        });
  },
};
</script>

<style>
.Morderth1 {
  width: 3%;
  text-align: center;
}
.Morderth2 {
  width: 14%;
  text-align: left;
 
}
.Morderth3 {
  width: 35%;
   border: 1px black solid;
}
.Morderth4 {
  width: 4%;
  text-align: center;
  border: 1px black solid;
}
.Morderth5 {
  width: 4%;
  text-align: center;
}
.Morderth6 {
  width: 4%;
  text-align: center;
  border: 1px black solid;
}
.Morderth7 {
  width: 4%;
  text-align: center;
}
.Morderth8 {
  width: 6%;
  text-align: center;
  border: 1px black solid;
}
.Morderth9 {
  width: 11%;
  text-align: center;
}
</style>