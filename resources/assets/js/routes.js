import VueRouter from 'vue-router';

let routes = [
	{
		path: "/",
		component: require('./components/Lists')
	},
	{
		path: "/lists/:id",
		component: require('./components/ShowList'),
		props: true
	},

]

export default new VueRouter({
	routes,
	// mode: "history",
	linkActiveClass: 'is-active',
});