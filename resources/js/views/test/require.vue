<template>

  <div style="  position:absolute;
                left:300px;
                height: 800px;
                width:1100px;
                top:100px;
                margin: 0px auto;" :disabled="isdisable == 0">
    <div class="topic">
      <h1>填寫客戶基本資料</h1>
    </div>
    <form action="submit.html" v-on:submit.prevent="postdata">
      <div class="row" style="height: 750px">
        <div class="col-md-5 mb-4">
         <input
                type="text"
                class="form-control"
                required:true
                style="width:300px"
                id="aa"
              />
                <button @click.prevent="save" type="submit">Post</button>
     </div>  </div>
    
    </form>
  </div>
  
</template>

<script>
const axios = require("axios");
export default {

  data() {
    return {
    
    };
  },
  methods: {
     
  },
  props: {
    msg: String,
  },
  beforeCreate() {
    axios
      .get("/api/search/CTD/客來源")
      .then((response) => {
        console.log(response.data.Cust);
        this.CustType = response.data;
      }),
      axios
        .get("/api/search/CTD/買原因")
        .then((response) => {
          console.log(response.data);
          this.BuyReason = response.data;
        }),
      axios
        .get("/api/search/CTD/成員組合")
        .then((response) => {
          console.log(response.data);
          this.Family = response.data;
        }),
      axios
        .get("/api/search/CTD/屋型")
        .then((response) => {
          console.log(response.data);
          this.HouseType = response.data;
        });
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.tableborder {
  width: 950px;
  margin: 0px auto;
}
.AF1tableborder {
  width: 950px;
  margin: 0px auto;
}
.bordertopic {
  width: 10%;
  font-size: 20px;
  margin: 0px auto;
  text-align: center;
  font-weight: solid;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.AF-checkbox {
  width: 20%;
  height: 50px;
  margin: 0px auto;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.AF-tablecheckbox {
  width: 30%;
  height: 100px;
  margin: 0px auto;
  padding: 0px 0px 0px 0px;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.AF11tableborder-250wid {
  font-size: 10px;
  border: 1px black solid;
}
.AF-tabletext {
  width: 40%;
  height: 100px;
  margin: 0px auto;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.AF-space {
  width: 1%;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
.tablecheckbox {
  width: 350px;
  height: 100px;
  margin: 0px auto;
  padding: 0px 0px 0px 0px;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-collapse: collapse;
}
.text-a-center {
  text-align: center;
}
.textw3 {
  width: 3%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw5 {
  width: 5%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw5px {
  width: 5px;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw10 {
  width: 50px;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw12 {
  width: 12%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw20 {
  width: 20%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw200px {
  width: 200px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw30 {
  width: 30%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.textw50 {
  width: 50%;
  padding: 10px 0px;
  color: #555;
  background-color: #fff;
  border: 1px solid black;
  font-size: 16px;
  font-weight: solid;
}
.topic {
  position: relative;
  margin-top: 10px;
  right: 250px;
}
</style>
