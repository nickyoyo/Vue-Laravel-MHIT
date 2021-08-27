<template>
	<Header></Header>
	<div class="main">
		<router-view></router-view>
	</div>
</template>

<script>
import { computed } from '@vue/runtime-core';
import { useStore } from 'vuex';
	import Header from "./Header";
	export default {
		components: { Header },
		setup(){
			const store = useStore();
			const count = computed(() => store.state.count);
		
		function increment(){
			store.commit("increment");
		}
		function decrement(){
			store.commit("decrement");
		}
		return {count ,increment ,decrement}
		}
	};
</script>

<style lang="css">
	/* GLOBAL STYLES */
	body {
		font-family: system-ui;
	}
	a,
	a:hover {
		text-decoration: none;
	}
	ul {
		list-style: none;
	}
	/* CUSTOM STYLES */
	header {
		background: rgb(0, 0, 0);
	}
	nav {
		display: flex;
		width: 1200px;
		height: 40px;
		margin: left;
		position: relative;
		left:100px;
	}
	nav h1.brand a {
		font-size: 26pt;
		color: rgb(255, 255, 255);
	}
	nav ul {
		display: flex;
		margin: 0;
	}
	nav ul li a {
		background: #292929;
		color: white;
		padding: 10px 20px;
		margin: 0px 10px;
	}
	nav ul li a:hover,
	nav ul li a.router-link-exact-active {
		color: white;
		border-bottom: 2px solid;
	}
	.main {
		display: flex;
		height: 300px;
		align-items: center;
	}
</style>
