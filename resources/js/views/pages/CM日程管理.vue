<template>

    <div class="topic" style="text-align: center">
      <h1>日程管理</h1>
    </div>
    <br />
      <div class="row" style="height: 800px">
        <div class="col-md-4 mb-4">
            <h2>目前客戶狀態</h2>
            丈量統計<br />
            <button @click.prevent="addMeasure" type="submit" :hidden="Mstate == 1"></button>
            <button @click.prevent="finishMeasure" type="submit" :hidden="Mstate == 2"></button>
        </div>
        <div class="col-md-4 mb-4">
        </div>
        <div class="col-md-4 mb-4">
      </div>
        <div class="col-md-4 mb-4">
        </div>
        <div class="col-md-4 mb-4">
        </div>
        <div class="col-md-4 mb-4">
            </div>
        <div class="col-md-4 mb-4">
        </div>
        <div class="col-md-4 mb-4">
        </div>
        <div class="col-md-4 mb-4">
      </div>
      
      

    </div>
</template>

<script>
const axios = require("axios");
export default {
  name: "CMpageDaymanage",
   data() {
       return{
         Mstate:1,
       }
   },
   methods: {
        addMeasure: function(){

        },
        finishMeasure: function(){

        },
   },
   mounted:{

   },
}
</script>