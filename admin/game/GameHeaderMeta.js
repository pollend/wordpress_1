var slideOptions = new Vue({
  el: '#game_snapshots',
  data:{games_images : []},
  methods: {
  	addEntry: function(event){
  		if(this.games_images == null)
  			this.games_images = [];
  		this.games_images.push({
  			image:"",
  		});
      event.preventDefault();
  	},
  	removeEntry: function(index,event){
  		this.games_images.splice(index,1);
      event.preventDefault();
  	},
  	setImage:function(index,event){
  		var temp = this.games_images[index];
		  window.send_to_editor = function(html) {
  			imgurl = jQuery(html).attr('src');
  			temp.image = imgurl;
  			tb_remove();
		  }
		  tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
      event.preventDefault();
  	}


  }
});
if(typeof game_image_payload !== null && game_image_payload != "")
  slideOptions.games_images = game_image_payload;

