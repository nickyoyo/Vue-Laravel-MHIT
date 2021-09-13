<template>
		<header class="row" style="height:60px;padding:8px 50px 10px 50px;">
			<div class="col-md-6 mb-4" style="font-size:30px;">
				<a href="/" style="color:white;">MHIT</a>
			</div>
			<div class="col-md-6 mb-4"  style="text-align:right;font-size:30px;">
				<a href="/auth/google" style="color:white;" :hidden="state == 2">Login</a>
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
			.get("/api/search/PD")
			.then((response) => {
			console.log(response.data);
			this.EMData = response.data;
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