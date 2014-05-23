var slides = new Array();
var slideSelect = new Array();
var currentPage = 1;

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

					jQuery('body,html').animate({scrollTop: 0}, 900);

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

	jQuery(window).trigger('resize');

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
			jQuery("#menu-container").transition({left:"-20%"},500,function(){});

			jQuery("#page").transition({width:"100%"},500,function(){});
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

	jQuery(window).on("mousedown DOMMouseScroll mousewheel keyup", function() {
    	jQuery("html, body").stop();
    	//jQuery("#menu-container").css({top:jQuery(window).scrollTop(),position:"absolute"});
		
	});
	History.Adapter.bind(window,'statechange',function(){ 
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-51267322-1', 'smoketreestudios.com');
		  ga('send', 'pageview');


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

    jQuery( window ).resize(function() {
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
		
		if(jQuery(window).width() <600)
		{
			jQuery("#minimizer").html("<");
			minimizer = true;
			jQuery("#page").attr("style","");
			jQuery("#menu-container").attr("style","");
		}

		jQuery("#main iframe[src^='http://www.youtube.com'] , #main iframe[src^='//www.youtube.com']").each(function(){
				jQuery(this).data('aspectRatio',this.height/this.width);
				jQuery(this).width(jQuery(".entry").width());
				jQuery(this).height(jQuery(".entry").width() * jQuery(this).data('aspectRatio'));
		});


    });
    
    LoadContainer(document.URL);
});






jQuery(window ).load(function(){

});


