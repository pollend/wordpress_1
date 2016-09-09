var slideOptions = new Vue({
  el: '#slide_options',
  data:{slides : []},
  methods: {
  	addEntry: function(){
      if(  typeof this.slides !== "object")
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
if(typeof slide_payload  !== 'undefined')
  slideOptions.slides = slide_payload;

