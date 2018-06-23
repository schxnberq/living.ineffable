<template>
<div class="lists">
	<alerts v-if="alert.status" :class="alert.type">
		<i slot="icon" :class="alert.icon"></i>
		<span slot="msg">{{ alert.msg }}</span>
	</alerts>
	<h2 class="site__title"><span>Hello {{ user.username }}!</span></h2>
<add-list @added="addToStream"></add-list>
<own-lists @delete="updateStream"></own-lists>
<shared-lists></shared-lists>
</div>
</template>

<style lang="scss">
	
</style>

<script>
import OwnLists from '../list-partials/OwnLists';
import SharedLists from '../list-partials/SharedLists';
import AddList from '../list-partials/AddList';
import Alerts from '../partials/Alerts';
export default {
	components: {
		OwnLists,
		SharedLists,
		AddList,
		Alerts
	},
	data() {
		return {
			alert: {
				type: '',
				msg: '',
				icon: '',
				status: false
			},
			user: [],
		}
	},
	created() {
		axios.get("/user/getUser")
		.then(user => this.user = user.data[0]);
	},
	methods: {
		addToStream(response) {
			this.alert.status = true;
			this.alert.type = 'success';
			this.alert.icon = 'check';
			this.alert.msg = 'List successfully created!';
		},
		toggleAlert() {
			(!this.alert.status) ? this.alert.status = true : this.alert.status = false;
		},
		updateStream(ev) {
			this.alert.status = true;
			this.alert.type = 'success';
			this.alert.icon = 'check';
			this.alert.msg = 'List successfully deleted!';
		}
		
	}
}
</script>