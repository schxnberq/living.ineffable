<template>
<div class="lists__grid">
	<h2 class="shared_list lists__title">Shared lists:</h2>
	<div class="lists__item" v-for="list in shared_lists">
		<div class="img">
			<router-link :to="`/lists/${list.id}`">
			<div v-if="placeholder(list.img)" class="placeholder">
				placeholder<span>(the creator of this list has not added a title image yet)</span>
			</div>
			<img v-else v-bind:src="list.img" v-bind:alt="list.name">
			</router-link>
		</div>
		<div class="info">
			<h3 class="lists__item__title">{{ list.name }} <span class="created_by">by {{ list.user.username }}</span></h3>
			<span class="created_at"><strong>last updated:</strong> {{ list.updated_at | ago }}</span>
		</div>
		<div class="actions">
			<router-link :to="`/lists/${list.id}`" class="btn shared_btn"><span>add links <i class="plus"></i></span></router-link>
		</div>
	</div>
</div>
</template>
<style lang="scss">
	
</style>
<script>
export default {
	data() {
		return {
			shared_lists: [],
			deleteModal: 'no-delete'
		}
	},
	filters: {
		ago(date) {
			return moment(date).fromNow();
		}
	},
	created() {
		axios.get("/user/lists")
		.then(response => this.shared_lists = response.data.shared_lists)
		.catch(error => console.log(error.response.data));

	},
	methods: {
		toggleDelete(ev) {
			if(this.deleteModal == "no-delete") {
				this.deleteModal = 'do-delete';
			} else {
				this.deleteModal = 'no-delete';
			}
		},
		placeholder(event) {
			return (event === "placeholder");
		}
	}
}
</script>