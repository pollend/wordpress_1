Vue.component('sub-menu-component',{


});

var SubMenuComponent = Vue.extend({
	el: '#app',
	data: function(){
		return {
			active:false,
			test: "test"
		}
	},
	methods: {
		onMouseOver: function(){
			this.active = !this.active;
		},
		onMouseLeave: function(){
			this.active = !this.active;
		}
	}
});
Vue.component('sub-menu-component', SubMenuComponent)


// define
var MyComponent = Vue.extend({
	el: '#app',
	template: '<div>A custom component!</div>'
});
// register
Vue.component('my-component', MyComponent)
// create a root instance
var vue = new Vue({
	el: '#app'
});