var slides = new Array();
var selector = new Array();
var isAutoOn = false;
var isLoaded = false;
function carousel_next_page () {

}

function carousel_back_page () {

}

function carousel_toggle_visible(isvisible){
	if(!isvisible)
	{
		if(!isLoaded)
		{
			jQuery("#slidePresentation").hide();
		}
		else
		{
			isAutoOn = false;
			jQuery("#slidePresentation").height(jQuery("#slidePresentation").height());
		
			jQuery("#slidePresentation").transition({height:0,marginBottom:0},900,function(){
				jQuery(this).hide();
			});
		}
	}
	else
	{
		jQuery("#slidePresentation").show();
		jQuery("#slidePresentation").transition({height:(jQuery("#slide").outerHeight()),marginBottom:20},900,function(){
			jQuery("#slidePresentation").attr("style","");
		});
	}

}

function carousel_init(){

	if(!isLoaded)
	{
		isLoaded = true;

		if(jQuery("#slides li").length == 1)
		{
			jQuery("#slideLeft").hide();
			jQuery("#slideRight").hide();
			jQuery("#slideSelect").hide();
				jQuery("#slide-load-bar").hide();
		}
		else
		{
			jQuery("#slideLeft").on("click",function(){

			});
			jQuery("#slideRight").on("click",function(){

			});

			jQuery("#slides li").each(function(){
				slides.push(jQuery(this));
				jQuery("#slideSelect").append("<li><div></div></li>");
			});
		}
	}


	if(!isAutoOn)
	{
		auto_carousel();
		isAutoOn = true;
	}
}

function auto_carousel(){

	jQuery("#slide-load-bar").transition({width:"100%"},10000,"linear",function(){
		jQuery("#slide-load-bar").transition({width:"0%"},200,function(){
			if(isAutoOn)
			auto_carousel();
		});
	});

}