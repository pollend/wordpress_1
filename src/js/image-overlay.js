//gallery group -> 0 = image 1 = caption
var gallerygroup = new Array();
var isImageOverlayActive = false;

var selectedGallery = 0;
var selectedImage = 0;

var lockImageProgression = false;

	//looks for each gallery grouping
	jQuery(".gallery").each(function(){

		var gallery = new Array();
		jQuery(this).find(".gallery-item").each(function(associatedImgID)
		{
			if(jQuery(this).find("a[href$='.jpg'],a[href$='.png']").length === 0)
			{
				jQuery(this).find(".wp-caption-text").css("display","block");
			}
			else
			{

				var item = new Array();
				item.push(jQuery(this).find("a").attr("href")); //push href onto item
				jQuery(this).find("a").attr("href", "#");//reassign href to #
				item.push(jQuery(this).find(".wp-caption-text").html());//push caption
				gallery.push(item);

				jQuery(this).find("a").on("click",{galleryID :(gallerygroup.length) , imageID : (gallery.length-1)},function(event){
					ImageOverlay(event.data.galleryID,event.data.imageID);
					return false;
				});

			}
		});

		gallerygroup.push(gallery);
	});

	jQuery("#image-overlay-close").on("click",function(){
		ImageOverlayClose();
		return false;
	});

	jQuery("#overlay-backdrop").on("click",function(){
		ImageOverlayClose();
		return false;
	});

	jQuery("#overlay-enlarged-image-container").on("click",function(){
		ImageOverlayClose();
		return false;
	});

	jQuery("#image-overlay-left").on("click",function(event){
		var imageID = selectedImage;
		imageID--;
		if(imageID < 0)
		{
			imageID = gallerygroup[selectedGallery].length -1;
		}
		ImageOverlay(selectedGallery,imageID);
		event.stopImmediatePropagation();
		return false;
	});
	jQuery("#image-overlay-right").on("click",function(event){
		var imageID = selectedImage;
		imageID++;
		if(imageID >= gallerygroup[selectedGallery].length)
		{
			imageID = 0;
		}
		ImageOverlay(selectedGallery,imageID);
		event.stopImmediatePropagation();
		return false;
	});


function ImageOverlay( gallerID,  itemID){

	if(isImageOverlayActive !== true)
	{
		isImageOverlayActive = true;

		jQuery("#overlay-backdrop").css({"display":"block","opacity":0});
		jQuery("#overlay-enlarged-image-container").css({"display":"block","opacity":0});
		jQuery("#overlay-backdrop").transition({opacity:1},500);
		jQuery("#overlay-enlarged-image-container").transition({opacity:1,top: (jQuery(document).scrollTop()+95)},500);
		jQuery("#image-overlay-caption").css("display","block");
	}
	

	//if(lockImageProgression === false)
	{
		lockImageProgression = true;
		selectedGallery = gallerID;
		selectedImage = itemID;

		var lItem = gallerygroup[gallerID][itemID];
		if(jQuery("#image-overlay-image").attr("src") !== lItem[0])
		{
			//set undefined to ""
			if(typeof lItem[1] === 'undefined')
			{
				lItem[1] ="";
			}
			//set caption and number of images
			jQuery("#image-overlay-caption .image-caption").html(lItem[1]);
			jQuery("#image-overlay-caption .num-images").html("image "+ (selectedImage +1)+" of " + gallerygroup[selectedGallery].length );
			jQuery("#image-overlay-caption .image-caption").attr("style","")
			jQuery("#image-overlay-caption .image-caption").css({opacity:"0"});

			jQuery("#image-over-loading").css({display:"block"});

			jQuery("#image-overlay-image").transition({"opacity":0},300,function(){
				jQuery("#image-overlay-image").one("load",function(){
					jQuery("#image-overlay-image").css({width:"auto",height:"auto"});

						var lImageWidth = jQuery("#image-overlay-image").width();
						var lImageHeight = jQuery("#image-overlay-image").height();
						var laspectRatio =lImageWidth/lImageHeight;
						var lScreenWidth = jQuery(window).width();
						var lScreenHeight = jQuery(window).height();

						//make sure image dosent leave screen
						if((lImageHeight+95) > lScreenHeight )
						{
							lImageWidth = Math.round(laspectRatio*(lScreenHeight));
							lImageHeight = Math.round(lScreenHeight-150);
						}
						if(lImageWidth > lScreenWidth)
						{
							lImageWidth = Math.round(lScreenWidth);
							lImageHeight =Math.round((lScreenWidth)/laspectRatio);
						}
						jQuery("#image-overlay-image").width(lImageWidth-10);
						jQuery("#image-overlay-image").height(lImageHeight-5);


						jQuery("#overlay-image").transition({width:lImageWidth},100,function(){
							jQuery("#overlay-image").transition({height:(lImageHeight + jQuery("#image-overlay-caption").height())},100,function(){
								
								jQuery("#image-overlay-caption .image-caption").transition({"opacity":1},100);
								jQuery("#image-overlay-image").transition({"opacity":1},300);	
								jQuery("#image-over-loading").css({display:"none"});
								lockImageProgression = false;
							});
						});
							

				}); 
				jQuery("#image-overlay-image").attr("src",lItem[0]); 
			});	
		}
	}


}

function ImageOverlayClose()
{
	if(isImageOverlayActive === true)
	{
		isImageOverlayActive = false;
		jQuery("#overlay-backdrop").transition({opacity:0},500);
		jQuery("#overlay-enlarged-image-container").transition({opacity:0},500,function(){
			jQuery("#overlay-backdrop").css({"display":"none"});
			jQuery("#overlay-enlarged-image-container").css({"display":"none"});
			
		});

	}

}


