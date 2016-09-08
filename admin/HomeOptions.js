var slideOptions = new Vue({
  el: '#slide_options',
  data:{slides : []},
  methods: {
  	addEntry: function(){
  		if(this.slides == null)
  			this.slides = [];
  		this.slides.push({
  			payload:"",
			link:"",
			blurb: ""
  		});
  	},
  	removeEntry: function(index){
  		this.slides.splice(index,1);

  	},
  	setImage:function(index){

  		var temp = this.slides[index];
		window.send_to_editor = function(html) {
			imgurl = jQuery(html).attr('src');
			temp.payload = imgurl;
			tb_remove();
		}

		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');


  	}


  }
});
slideOptions.slides = slide_payload;

