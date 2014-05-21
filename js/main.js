var slides = new Array();
var slideSelect = new Array();
var currentPage = 1;

var mainAreaHeight = 0;

var allVideos = 0;
var contentAreaWidth;

var smallWindowMenu = false;
var minimizer = true;

var internal = false;

var isLoadingPage = false;


function LoadContainer(url)
{
	if(!isLoadingPage)
	{
		isLoadingPage = true;
		if(url.indexOf(".jpg") > -1||url.indexOf(".png") > -1)
		{
			window.open(url, '_blank').focus();	
		}
		else
		{

			//internal = true;
			url = url.replace('#','&');
			History.pushState(null, "Loading...", url);

			if(url.indexOf("?") > -1)
			{
				url += "&empty=full_page"
			}
			else
			{
				url += "?empty=full_page"
			}

			jQuery( "#main" ).transition({opacity:0},200,function(){
				jQuery( "#main" ).load(url,function(){

					jQuery( "#main" ).transition({opacity:1},200);
					document.title = jQuery( "#main" ).find("title").html();

					OnLoadContent();
					if(typeof PageScript == 'function')
					PageScript();
					isLoadingPage = false;
				});
			});
		}
	}
}

function OnLoadContent()
{
	
	jQuery("#main a").each(function(element){
		jQuery(this).unbind('click').on("click",function(event)
		{
			if(jQuery(this).attr("href").indexOf(window.location.host) > -1)
			{
				event.preventDefault();
				LoadContainer(jQuery(this).attr("href"));
			}
		});
	});


	UpdateImageViews();


}


jQuery(document).ready(function () {

	if (!jQuery.support.transition)
  		jQuery.fn.transition = jQuery.fn.animate;

  	jQuery(".sub-menu").each(function(){
		jQuery(this).addClass("children");
	});
	
	jQuery(".menu a").each(function(element){
		jQuery(this).on("click",function(event)
		{
			if(jQuery(this).attr("href").indexOf(window.location.host) > -1)
			{
				event.preventDefault();
				LoadContainer(jQuery(this).attr("href") );
				jQuery(".menu .current_page_item").removeClass("current_page_item");
				jQuery(this).parent().addClass("current_page_item");
			}
		});
	});

	jQuery("#searchForm").on("submit",function(event)
	{
		event.preventDefault();
		LoadContainer(jQuery(this).attr('action') + "?s=" + jQuery(this).find("#s").val());
		 jQuery(this).find("#s").val("");
	});

	jQuery(".menu li").each(function(element){

		if(jQuery(this).find(".children").length > 0)
		{
			jQuery(this).attr("id","item-" + element);

			jQuery("#"+this.id + ", #" + this.id + ">.children").on("mouseenter",{submenu:jQuery("#"+this.id + ">.children")},function(event){
				if(smallWindowMenu === false)
				event.data.submenu.css("display","block");

			});

			jQuery("#"+this.id + " , #" + this.id + ">.children").on("mouseleave",{submenu:jQuery("#"+this.id + ">.children")},function(event){
				if(smallWindowMenu === false)
				event.data.submenu.css("display","none");
			});
		}

	});

	jQuery("#minimizer").on("click",function(event){
		if(minimizer)
		{
			jQuery("#minimizer").html(">");
			minimizer = false;
			jQuery("#menu-container").transition({left:"-20%"},500,function(){

			});

			jQuery("#page").transition({width:"100%"},500,function(){

			});
		}
		else
		{
			jQuery("#minimizer").html("<");
			minimizer = true;
			jQuery("#menu-container").transition({left:"0%"},500,function(){

			});

			jQuery("#page").transition({width:"80%"},500,function(){

			});
		}
		return false;
	});

	jQuery(window).on("mousewheel", function() {
    	jQuery("html, body").stop();
	});
	History.Adapter.bind(window,'statechange',function(){ 
		if(typeof pageEvent == 'function' && pageEvent() == true)
		{
	
    	}
    	else
    	{
    		if(!internal)
			{
	        	var State = History.getState();
	        	LoadContainer(State.url);
	    	}
    	}
    	internal = false;
    	
    });
    
    CheckForHeightChange();
});

function CheckForHeightChange()
{
	if(jQuery("#main").height() !== mainAreaHeight)
	{

		if(jQuery("#menu-drop-down").is(":visible") )
		{
			jQuery(".children").css("display","block");
			smallWindowMenu = true;
		}
		else
		{
			jQuery(".children").css("display","none");
			smallWindowMenu = false;
		}

		//jQuery("#page").height("auto");
		//var extraSpace = jQuery(document).height() - jQuery("#page").height();

		//if(extraSpace !== 0)
		//jQuery("#page").height(jQuery("#page").height() + extraSpace);

		//jQuery("#page").height(jQuery("#main").outerHeight());
	//	if(jQuery("#main").outerHeight() <  jQuery(document).height())
		//{
		//		jQuery("#page").height(jQuery(document).height());
		//}


		contentAreaWidth = jQuery(".entry").width();

		if(allVideos !== 0 )
		allVideos.each(function(){
			jQuery(this).width(contentAreaWidth);
			jQuery(this).height(contentAreaWidth * jQuery(this).data('aspectRatio'));
		});

	}
	mainAreaHeight = jQuery("#main").height();
	setTimeout(CheckForHeightChange, 100);
}






jQuery(window).load(function(){

	allVideos = jQuery("#contentContainer iframe[src^='http://www.youtube.com']");

	allVideos.each(function(){
		jQuery(this).data('aspectRatio',this.height/this.width);
		jQuery(this).removeAttr('height').removeAttr('width');
	});
	LoadContainer(document.URL);
});


