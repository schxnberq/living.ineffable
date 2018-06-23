<template>
	<div class="alert">
		<slot name="icon"></slot>
		<slot name="msg"></slot>
	</div>
</template>

<style lang="scss">
	
</style>

<script>
export default {
	data() {
		return {
			type: '',
			msg: 'Alert'
		}
	},

	created() {
		setTimeout(function() {
	        document.querySelector(".alert").style.opacity = 0;
	        document.querySelector(".alert").style.top = "-25px";
	        setTimeout(function() {
	            document.querySelector(".alert").remove();
	        }, 1000);
	    }, 4500)
	},

	methods: {

	}
	
}
</script>
