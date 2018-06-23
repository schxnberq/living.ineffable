<template>
<div class="lists__grid">
	<h2 class="own_list lists__title">Your lists:</h2>
	<div class="lists__item" v-for="list in own_lists">
		<span class="list_item_id" :id="list.id"></span>
		<div class="img">
			<router-link :to="`/lists/${list.id}`">
			<div v-if="placeholder(list.img)" class="placeholder">
				placeholder<span>(click on edit to choose title image)</span>
			</div>
			<img v-else v-bind:src="list.img" v-bind:alt="list.name">
			</router-link>
		</div>
		<div class="info">
			<h3 class="lists__item__title">{{ list.name }} <span class="created_by">by you</span></h3>
			<span class="created_at"><strong>last updated:</strong> {{ list.updated_at | ago }}</span>
		</div>
		<div class="actions">
			<router-link :to="`/lists/${list.id}`" class="btn feedback"><span>edit <i class="fas fa-pencil-alt"></i></span></router-link>
			<button @click="toggleDelete" class="btn delete-btn feedback"><span>delete <i class="fas fa-trash-alt"></i></span></button>
			<div class="delete">
				<span class="head">Do you really want to <strong>permanently</strong> delete this list?</span>
				<button @click="closeDelete" class="btn feedback no"><span>no!</span></button>
				<form @submit.prevent="onDelete(list.id)" method="POST" action="/user/lists">
					<button class="btn feedback yes" type="submit">Yes</button>
				</form>
			</div>
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
			own_lists: [],
		}
	},
	filters: {
		ago(date) {
			return moment(date).fromNow();
		}
	},
	created() {
		axios.get("/user/lists")
		.then(response => {
			this.own_lists = response.data.own_lists
			console.log(response.data);
		})
		.catch(error => console.log(error.response.data));

	},
	methods: {
		toggleDelete(ev) {
			ev.target.nextElementSibling.classList.toggle("do-delete");
			document.addEventListener("keydown", function(key) {
				if(key.keyCode == 27) {
					ev.target.nextElementSibling.classList.remove("do-delete");
				}
			});
		},
		closeDelete(ev) {
			ev.target.parentNode.classList.remove("do-delete");
		},
		placeholder(event) {
			return (event === "placeholder");
		},
		onDelete(id) {
			axios.delete('/user/lists/' + id);
			this.$emit('delete', 'true');
			document.querySelector(".do-delete").classList.remove("do-delete");

			let updated_list = this.own_lists.filter(el => el.id !== id);
			let find = this.own_lists.filter(el => el.id == id);
			
			let item = document.getElementById(find[0].id);
			item.parentNode.classList.add("remove-item");
			
			setTimeout(function(){
				item.parentNode.remove();
				this.own_lists = updated_list;
			}, 1000);

		}
	}
}
</script>