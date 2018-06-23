<template>
<div class="list_cnt">
	<div class="back" v-if="!loading">
		<router-link to="/"><span>back to</span> <strong>your lists</strong></router-link>
	</div>
	<div class="loading" v-if="loading">
		<span>loading <i>.</i><i>.</i><i>.</i></span>
		<em>please wait</em>
	</div>
	<div class="list__header" v-if="!loading">
		<h2><span>{{ list.name }}</span> <em>{{ list.name }}</em></h2>
		<div class="list_people created_by">
			<h3>List created by:</h3>
			<span>{{ list.user.username }}</span>
		</div>
		<div class="list_people members">
			<h3>List members:</h3>
			<div v-if="!isShared" class="shared_with invite">
				<span><em>Invite</em> others to see this list</span>
			</div>
			<div v-else class="shared_with" v-for="user in shared_with">
				<span>{{ user.username }}</span>
			</div>
			<!-- {{ isShared }} -->
		</div>
		
	</div>
<add-list-item v-if="!loading" @added="addItem"></add-list-item>
<div class="items">
	<div class="list__item" v-for="item in items">
		<img :src="item.image" alt="">
		<div class="info">
			<p v-if="item.description" class="description">
				<strong>{{ createdByFormat(item.created_by) }} said:</strong>
				<span>{{ item.description }}</span>
			</p>
			<p><strong>Created by:</strong> {{ createdByFormat(item.created_by) }}, {{ item.created_at }}</p>
		</div>
	</div>
</div>
</div>
</template>
<!--
+ + TODO + +
LIST MEMBERS:
	- add your PHP "API" Function
	
-->
<style lang="scss">
	
</style>
<script>
import AddListItem from "../list-partials/AddListItem";
import Alerts from "../partials/Alerts";
export default {
	components: {AddListItem, Alerts},
	props: ['id'],
	data() {
		return {
			list: [],
			shared_with: [],
			items: [],
			loading: true
		}
	},
	created() {
		axios.get("/user/lists/" + this.id)
		.then(response => {
			this.loading = false;
			this.list = response.data.list[0];
			this.shared_with = response.data.shared_with[0];
			this.items = response.data.items;
		})
	},
	computed: {
		isShared() {
			return Object.keys(this.shared_with).length > 0
		}
	},
	methods: {
		addItem(data) {
			console.log(data);
		},
		createdByFormat(str) {
			return str.charAt(0).toUpperCase() + str.slice(1);
		}
	}
}
</script>