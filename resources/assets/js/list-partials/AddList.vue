<template>
<div class="addlist">
	<button @click="toggleActive" :class="create" >new list <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i></button>
	<div class="overlay" :class="create"></div>
	<form autocomplete="off" enctype="multipart/form-data" @submit.prevent="onSubmit" action="/user/lists" method="POST" :class="create">
		<input v-model="form.items" type="hidden" name="items" id="items">
		<input v-model="form.img" type="hidden" name="img" id="img">
		<input v-model="form.shared_with" type="hidden" name="shared_with" id="shared_with">
		<div class="field is-half">
			<label for="name" class="label">List name:</label>
			<div class="control">
				<input class="input" v-model="form.name" type="text" name="name" id="name" placeholder="New list">
				<span class="errormsg" v-text="form.errors.get('name')"></span>
			</div>
		</div>
		<div class="field is-half submit">
			<button type="submit" class="create">Create list</button>
		</div>
	</form>
</div>
</template>
<style lang="css">
	div.message {
		margin-top: 45px;
	}
	div.control:last-child {
		margin-top: 20px;
	}
</style>
<script>
	export default {
		data() {
			return {
				form: new Form({name: '', items: 'placeholder', img: 'placeholder', shared_with: 'placeholder'}),
				create: 'inactive',
			}
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
				this.form.post("/user/lists")
				.then(list => alert(response.data));

				window.location.reload();
				this.create = 'inactive';
			},
			
		}
	}
</script>