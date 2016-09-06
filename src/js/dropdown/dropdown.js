

var dropdown = new Vue({
	el: '.page_item_has_children',
	test : "working",
	methods: {
		onMouseOver: function(){
			this.active = true;   
		},
		onMouseLeave: function() {
			this.active = false;
		}

	}

});