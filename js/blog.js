
var isLoadingMorePost = false;
var isSingleton = false;
var oldScrollPosition = 0;

function PageScript(){
	OnLoadContent();

	jQuery(".navigator a").each(function(){
		jQuery(this).unbind('click').on("click",function(){
			event.preventDefault();
			if(!isLoadingMorePost)
			{
				isLoadingMorePost = true;
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
					
					isLoadingMorePost = false;
				});
			}
		});
	});

	jQuery("#contentContainer>div").each(function(){
		jQuery(this).find(".postTitle a").unbind('click').on("click",function(){
			event.preventDefault();
			if(!isLoadingMorePost)
			{
				isLoadingMorePost = true;

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

				jQuery('body,html').animate({scrollTop: 0}, 900);
				isSingleton = true;


				jQuery("#contentContainer>.post").each(function(){
					jQuery(this).height(jQuery(this).height());

					if (jQuery(this).attr("id") !== post.attr("id")) {
						jQuery(this).transition({height:0,marginBottom:0},900,function(){
							jQuery(this).hide();
							isLoadingMorePost = false;

							//rebind for post link to be back button
							jQuery(post_link).unbind("click").on("click",function(){
								event.preventDefault();
								ListPost();

								internal = true;
								History.back();

							});

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
							var orignalHeight = post.height();
							post.css({height:"auto"});
							var newHeight = post.height();
							post.css({height:orignalHeight});

							post.transition({height:newHeight},900,function(){
								post.css({height:"auto"});

							});

						});
					}

				});
			}


		});
	});
}

function pageEvent(state){


	if(isSingleton)
	{
		isSingleton = false;
		ListPost();
		return true;
	}
	return false;
}


function ListPost(){
	jQuery("#contentContainer>div").each(function(){
		if(jQuery(this).css("display") === "none")
		{
			jQuery(this).show();
			jQuery(this).height('auto');

			var lheight =  jQuery(this).height();
			jQuery(this).height(0);
			jQuery(this).transition({height:lheight,marginBottom:30},900,function(){
				jQuery(this).removeAttr("style");
			});
		}
		else
		{
				jQuery(this).find(".comment-container").height('auto');
				var lheight = jQuery(this).find(".comment-container").height();
				jQuery(this).find(".comment-container").height(lheight);
				jQuery(this).find(".comment-container").transition({height:0},900,function(){
				jQuery(this).find(".comment-container").css({display:"none"});
			});
		}
	});
	PageScript();
 	jQuery('body,html').animate({scrollTop: oldScrollPosition}, 900);

 	document.title = jQuery("#main").find("title").html();
}