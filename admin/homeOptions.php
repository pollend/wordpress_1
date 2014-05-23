<?php

	add_action('admin_init', 'gray_home_init');
    function gray_home_init(){
	

    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/admin/HomeOptions.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_enqueue_style('thickbox');

		register_setting( 'gray_home_options', 'gray_home_options');

        add_settings_section('gray_slides', 'Slides', 'gray_slide_section', 'gray_home_slide_settings');
        add_settings_field('Slides', 'Slides', 'gray_slide_field', 'gray_home_slide_settings', 'gray_slides');

       
    }




    function gray_slide_section() {
   	?>

  	  <div>Note: images will have to maintain a 2:1 ratio to function properly in the slide show</div>
	  <div>Note: A single slide will be viewed without a carousel </div>
	  <div>Note: enable HTML input allows html to be directly placed into each slide</div>
	 
  	  <?php
    } 

    function gray_slide_field() {
    	$options = get_option("gray_home_options");
        ?> 
	        <div id="slide_options">
		        <?php 
		        for($x = 0; $x < count($options["Slide"]); $x++)
		        {
		        	?>
		        	<div id="slides_option_container<?php echo $x ?>">
						<input id="upload_image<?php echo $x ?>" type="text" size="36" name='gray_home_options[Slide][<?php echo $x; ?>]' value="<?php echo  htmlentities($options["Slide"][$x]) ?>" />
						<input id="upload_image_button<?php echo $x ?>" type="button" value="Upload Image" />
						<input id="remove_slide<?php echo $x ?>" type="button" value="remove" /></br>Input raw HTML into slide: 
						<input name='gray_home_options[isHTML][<?php echo $x; ?>]' <?php echo empty($options["isHTML"][$x]) ? "" : "checked"; ?> value="1" type="checkbox"/>
					</div>
		        	<?php
		        }
		        ?>
	        </div>
	         <div><a id="addSlide" href="#">add Slide</a></div>
        <?php

    }

    function gray_home_option_validate($input){
    	$index = 0;
		for($x = 0; $x < $input["numslides"]; $x++)
	    {
	    	if($input["Slide".$x] == "")
	    	{
	    		unset($input["Slide".$x]);
	    	}
	    	else
	    	{
	    		if(("Slide".$x) != ("Slide".$index))
	    		{
	    			$input["Slide".$index] = $input["Slide".$x];
	    			unset( $input["Slide".$x]);
	    		}
	    		$index++;
	    	}
	    }
	    $input["numslides"] = $index;
    	return  $input;
    }


function gray_home_options_page()
{
	if (!current_user_can('manage_options'))
    {
      wp_die( 'You do not have sufficient permissions to access this page.');
    }

	?>
	<script type="text/javascript">
	</script>

	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Theme Options</h2>
	    
	<form action="options.php" method="post" >
		<?php settings_fields('gray_home_options'); ?>

		<?php do_settings_sections('gray_home_slide_settings'); ?>
		<?php submit_button(); ?>
	</form>

	<?php
}
?>