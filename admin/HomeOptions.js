

jQuery(document).ready(function() {
	jQuery(".Upload div").each(function(element){
		jQuery("#"+this.children[1].id).on("click",{field : "#"+this.children[0].id},function(event) {
			 formfield = jQuery(event.data.field).attr('name');

			window.send_to_editor = function(html) {
			 imgurl = jQuery('img',html).attr('src');
			 jQuery(event.data.field).val(imgurl);
			 tb_remove();
			}

			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			 return false;
		});
	});

	jQuery("#slide_options div").each(function(element){

	 	jQuery("#"+this.children[1].id).on("click",{field : "#"+this.children[0].id},function(event) {
			 formfield = jQuery(event.data.field).attr('name');

			window.send_to_editor = function(html) {
			 imgurl = jQuery('img',html).attr('src');
			 jQuery(event.data.field).val(imgurl);
			 tb_remove();
			}

			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			 return false;
		});

		jQuery("#"+this.children[2].id).on("click",{item : "#"+this.id },function(event){
			jQuery(event.data.item).remove();
		});

	});

	jQuery("#addSlide").on("click",function(){
       

		if(jQuery("#gray_options_number_slides").val() == "")
		{
			jQuery("#gray_options_number_slides").val(1);
		}
		jQuery("#gray_options_number_slides").val((parseInt(jQuery("#gray_options_number_slides").val()) + 1) + "");
		var slideID =jQuery("#slide_options div").length;
		jQuery("#slide_options").append("<div id=\"slides_option_container"+slideID+"\"><input id=\"upload_image"+slideID+"\" type=\"text\" size=\"36\" name=\"gray_home_options[Slide]["+slideID+"]\" value=\"\" /><input id=\"upload_image_button"+slideID+"\" type=\"button\" value=\"Upload Image\" /><input id=\"remove_slide"+slideID+"\" type=\"button\" value=\"remove\" /></br>Input raw HTML into slide: <input name=\"gray_home_options[isHTML]["+slideID+"]\"value=\"1\" type=\"checkbox\"/></div>");


		jQuery("#upload_image_button" + slideID).on("click",{field : ("#upload_image"+slideID)},function(event) {
			 formfield = jQuery(event.data.field).attr('name');

			window.send_to_editor = function(html) {
			 imgurl = jQuery('img',html).attr('src');
			 jQuery(event.data.field).val(imgurl);
			 tb_remove();
			}

			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			 return false;
		});

		jQuery("#remove_slide" +slideID ).on("click",{item : "#slides_option_container"+slideID },function(event){
			jQuery(event.data.item).remove();
		});
	});



  
});