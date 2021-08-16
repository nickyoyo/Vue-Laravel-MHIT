<template>  
   <div class="container text-center">
                    <h1>歡迎使用本系統</h1>         
               <br><br>
               <ul class="navigation" style="position:absolute;left:20%;">
                <li>  
                    <dl>
                        <dt>門市作業</dt> 
                        <dd><router-link to="/CM/sendSearch" >客戶資料</router-link></dd>
                        <dd></dd>
                        <dd></dd>
                    </dl>
                    </li> 
                <li>  
                    <dl>
						<dt>TEST</dt> 
						<dd><router-link to="/PersonalData" >員工資料</router-link></dd>
                        <dd><router-link to="/Login" >|功能B-修改特定需求</router-link></dd>
                        <dd><router-link to="//CM/create">功能B-顯示剛修改需求</router-link></dd>
                    </dl>
                </li> 
            </ul>

               <br><br>                  
        </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: 'Home',
  components: {

  }
}
</script>
<style type="text/css">
/* 整體設置*/ 
.navigation {
	margin:0; 
	padding:0;
	width:1200px;
	list-style-type:none; 
	font:12px Arial; 
	}
    
.navigation li {
	float:left; 
    padding:0; 
	margin:0 50px 0 0; 
	width:108px;
	}
 
/* 設置選單區塊*/
.navigation li dl { 
	width:150px;
    margin:0; 
	padding:0;
	background-color:#fff;
	border:solid 2px; 
	}
 
.navigation li dt a , .navigation li dd a{ display:block;}
 
 
/* 設置主選單dt */
.navigation li dt {
	margin:0;
	padding: 5px;
	text-align:center;
	background-color:#fff;	
	font-size: 12px;
	font-weight: bold;
	height:25px;
	overflow:hidden;
	}
 
.navigation li dt a ,.navigation  li dt a:visited {
	display:block; 
    color:#333;
    text-decoration:none;
	}
 
/* 設置子選單dd */
.navigation li dd { 
	margin:0; 
	background-color:#efefef;
	border-bottom:solid 1px;
	}
  
.navigation li dd a, .navigation  li dd a:visited {
	display:block; 
	color:black; 
    text-decoration:none; 
	padding:10px 5px 10px 5px;
    text-align:center;
    }
 
 
/*隱藏子選單*/
.navigation li dd { display:none;}
 
 
/* 滑鼠滑入顯示子選單 */
.navigation li:hover dd, .navigation li a:hover dd { display:block;}
 

</style>