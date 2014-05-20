
var isLoadingMorePost = false;

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


				jQuery('body,html').animate({
							scrollTop: 0
						}, 900);

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

						PageScript();
					});
					document.title = jQuery("#contentContainer title").html();
					isLoadingMorePost = false;
				});
			}
		});
	});

	jQuery("#contentContainer>div").each(function(){
		jQuery(this).find(".postTitle a").unbind('click').on("click",function(){
			event.preventDefault();

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

			jQuery('body,html').animate({
									scrollTop: 0
								}, 900);


			jQuery("#contentContainer>div").each(function(){
				jQuery(this).height(jQuery(this).height());
				if (jQuery(this).attr("id") !== post.attr("id")) {
					jQuery(this).transition({height:0},900,function(){
						jQuery(this).hide();
					});
				}
				else
				{
					jQuery("<div>").load(url,function()
					{
						post.append(jQuery(this).find(".comment-container").wrap("<p>").parent().html());
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


		});
	});
}

function pageEvent(state){
	
}