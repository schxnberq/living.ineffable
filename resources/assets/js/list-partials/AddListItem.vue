<template>
	<div class="additem">
		<button class="create" @click="toggleActive" :class="create" >Add a link: <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i></button>
		<form @submit.prevent="onSubmit" autocomplete="off" action="/user/lists/" :class="create" method="POST">
			<div class="field">
				<label for="link" class="label">Link:</label>
				<div class="control">
					<input v-model="form.link" type="text" class="input" name="link" id="link">
					<span class="errormsg" v-if="form.errors.has('link')" v-text="form.errors.get('link')"></span>
				</div>
			</div>
			<div class="field">
				<label for="description" class="label">Description:</label>
				<div class="control">
					<textarea class="input" v-model="form.description" name="description" id="description"></textarea>
					<span class="errormsg" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
				</div>
			</div>
			<div class="field submit">
				<button type="submit" class="btn feedback">Add Link!</button>
			</div>
		</form>
	</div>
</template>

<style lang="scss">
	
</style>

<script>
export default {
	data() {
		return {
			form: new Form({link: '', description: ''}),
			create: 'inactive'
		}
	},
	mounted() {
		console.log("AddListItem component mounted!");
		// console.log(this.$parent.id);
	},
	methods: {
		toggleActive(ev) {
				if(!ev.target.classList.contains('active')) {
					let it = this;
					document.addEventListener("keydown", function(key) {
						if (key.keyCode == 27) {
							console.log("FIN");
							it.create = 'inactive';
						}
					});
					this.create = 'active';
				} else {
					this.create = 'inactive';
				}
			},
			onSubmit() {
				console.log(this.$parent.id);
				this.form.post("/user/lists/" + this.$parent.id)
				.then(response => console.log(response));
				// this.$emit("added", this.form);
			}
	}
}
</script>
	