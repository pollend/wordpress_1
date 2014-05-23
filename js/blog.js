
var isSingleton = false;
var oldScrollPosition = 0;

function PageScript(){
	OnLoadContent();
	
	jQuery(".navigator a").each(function(){
		if(jQuery(this).hasClass("selected"))
		{
			if(jQuery(this).html() === "1")
			{
				carousel_toggle_visible(true);
			}
			else
			{
				carousel_toggle_visible(false);
			}
		}
		jQuery(this).unbind('click').on("click",function(){
			event.preventDefault();

				var url =  jQuery(this).attr("href");

				internal = true;
				History.pushState(null, "Loading...", url);

				url = url.replace('#','&');
				if(url.indexOf("?") > -1)
				{
					url += "&empty=next_post"
				}
				else
				{
					url += "?empty=next_post"
				}


				jQuery('body,html').animate({scrollTop: 0}, 900);

				jQuery("#contentContainer").transition({opacity:0},900,function()
				{
					jQuery("#contentContainer").html("");	
					jQuery("<div>").load(url,function()
					{
						jQuery(".post",jQuery(this)).each(function(index,event){
							jQuery("#contentContainer").append(jQuery(this).wrap("<p>").parent().html());
						});
						jQuery(".navigator").html(jQuery(this).find(".navigator").html());
						jQuery("#contentContainer").transition({opacity:1},900);
						document.title = jQuery(this).find("title").html();
						PageScript();
					});
					
				});
			
		});
	});

	jQuery("#contentContainer>div").each(function(){
		jQuery(this).find(".postTitle a").unbind('click').on("click",function(){
			event.preventDefault();


				if(isSingleton)
				{
					internal = true;
					History.back();
				}
				else
				{

					var post_link = jQuery(this);
					var post = jQuery(this).parent().parent();
					var url = jQuery(this).attr("href");

					internal = true;
					History.pushState(null, "Loading...", url);

					url = url.replace('#','&');
					if(url.indexOf("?") > -1)
					{
						url += "&empty=comments"
					}
					else
					{
						url += "?empty=comments"
					}
					oldScrollPosition = jQuery(document).scrollTop();
					jQuery('body,html').animate({scrollTop:  jQuery("#blog-container").offset().top}, 900);
					isSingleton = true;


					jQuery("#contentContainer>.post").each(function(){
						jQuery(this).height(jQuery(this).height());
						jQuery(this).data("height",jQuery(this).height());
						if (jQuery(this).attr("id") !== post.attr("id")) {

							jQuery(this).transition({height:0,marginBottom:0},900,function(){
								jQuery(this).hide();
							});
						}
						else
						{
							jQuery("<div>").load(url,function()
							{

								post.find(".comment-container").empty();

								post.find(".comment-container").append(jQuery(this).wrap("<p>").html());
								post.find(".comment-container").attr("style","");

								document.title = jQuery(this).find("title").html();
			
								post.transition({height:post.data("height") + post.find(".comment-container").height()},900,function(){
									post.css({height:"auto"});

								});

							});
						}

					});
				}
			
		});
	});
	carousel_init();
}

function pageEvent(state){


	if(isSingleton)
	{
		ListPost();
		return true;
	}
	return false;
}


function ListPost(){
	isSingleton = false;
	document.title = jQuery("#main").find("title").html();
	jQuery("#contentContainer>div").each(function(){
		if(jQuery(this).css("display") === "none")
		{
			jQuery(this).show();
			jQuery(this).transition({height:jQuery(this).data("height"),marginBottom:30},900,function(){
				jQuery(this).removeAttr("style");
			});
		}
		else
		{
			jQuery(this).height(jQuery(this).height());
			jQuery(this).transition({height:jQuery(this).data("height"),marginBottom:30},900,function(){
				jQuery(this).removeAttr("style");
				jQuery(this).find(".comment-container").css({display:"none"});
			});
		}
	});
    var orig = jQuery(document).scrollTop();
    window.scrollTo = orig;

 	jQuery('body,html').animate({scrollTop: oldScrollPosition}, 900);

}