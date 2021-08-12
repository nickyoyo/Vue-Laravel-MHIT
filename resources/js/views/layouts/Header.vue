<template>
		<header class="row" style="height:60px;padding:8px 50px 10px 50px;">
			<div class="col-md-6 mb-4" style="font-size:30px;">
				<router-link to="/" style="color:white;">MHIT</router-link>
			</div>
			<div class="col-md-6 mb-4"  style="text-align:right;font-size:30px;">
				<a href="" @click.prevent="LoginPD" style="color:white;" :hidden="state == 2">登入</a>
				<a href="" @click.prevent="PD" style="color:white;" :hidden="state == 1">{{EMData.EMME}}</a>
				<a href="/" @click.prevent="LogoutPD" style="color:white;" :hidden="state == 1">登出</a>
			</div>
		</header>
</template>

<script>
	export default {
	 data() {
			return {
			EMData:[],
			state:1,
			};
		},	
	methods:{
		PD:function(){
			const EMID = this.EMData.EMID
			this.$router.push({ name: "PersonalData", params: { EMID } });
		},
		LoginPD:function(){
			axios
			.get("http://127.0.0.1:8000/api/search/PD/"+"21072177")
			.then((response) => {
			console.log(response.data);
			this.EMData = response.data.EM13;
			if(response.data!= null) {
				this.state = 2;
				sessionStorage.setItem('store', EMData);
				console.log(sessionStorage.getItem('store')) 
			}
		})
		},
		LogoutPD:function(){
			this.$router.push({ name: "Home"});
			this.state = 1;
			this.EMData ='';
		}
	 },

	};
</script>