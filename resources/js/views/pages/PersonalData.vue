<template>

  <div class="container text-center" style="padding: 50px">
            <h1>個人資料</h1>     
    <table class="PDtableborder">
      <tr>
        <th class="PDtopic">名稱</th>
        <th class="PDtopic">英文名稱</th>
        <th class="PDtopic">信箱</th>
        <th class="PDtopic">部門</th>
        <th class="PDtopic">部門編號</th>
      </tr>
        <tr>
            <td class="textw10 text-a-center">{{pd.EMME}}</td>
            <td class="textw12 text-a-center">{{pd.ENME}}</td>
            <td class="textw30 text-a-center">{{pd.E_MAIL}}</td>
            <td class="textw5 text-a-center">{{pd.POID}}</td>
            <td class="textw5 text-a-center">{{pd.DVID}}</td>
        </tr>
    </table>
  </div>
</template>

<script>
// @ is an alias to /src
const axios = require("axios");
export default {
  name: "PersonalData",
  components: {},
  data() {
    return {
      pd: [],
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/search/PD/21072177")
      .then((response) => {
        console.log(response.data.EM13);
        this.pd = response.data.EM13;
      });
  },
};
</script>
<style type="text/css">
.PDtableborder {
  width: 900px;
  margin: 0px auto;
}
.PDtopic {
  width: 10%;
  font-size: 20px;
  margin: 0px auto;
  text-align: center;
  font-weight: solid;
  border: 1px solid black;
}
.text-a-center {
  text-align: center;
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
</style>