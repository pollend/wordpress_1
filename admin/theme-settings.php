<?php

	add_action('admin_init', 'gray_home_init');
    function gray_home_init(){
	


		wp_register_script('theme_options', get_template_directory_uri() .'/admin/ThemeSettings.js', array('jquery','media-upload','thickbox'),1,true);
    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script( 'vue',  get_template_directory_uri() ."/js/vue/vue.min.js",'1');

		register_setting( 'home_slides', 'home_slides');

        add_settings_section('slide_section', 'Slides', 'slide_section', 'slide_settings');
        add_settings_field('slides_field', 'Slides', 'slide_field', 'slide_settings', 'slide_section');

       
    }




    function slide_section() {
   	?>

  	  <div>Note: images will have to maintain a 2:1 ratio to function properly in the slide show</div>
	  <div>Note: A single slide will be viewed without a carousel </div>
	  <div>Note: enable HTML input allows html to be directly placed into each slide</div>
	 
  	  <?php
    } 

    function slide_field() {
    	wp_enqueue_script("theme_options");
    	$options = get_option("home_slides");
        ?> 


        <script>
	        <?php if(isset($options)):?>
	        	var slide_payload = <?php echo json_encode($options); ?>
	        <?php else: ?>
	        	var slide_payload = [];
	        <?php endif; ?>
        </script>

        
	        <div id="slide_options">


	        	<div v-for="sl in slides">

					<input type="text" size="36" name='home_slides[{{ $index }}][payload]' value="{{ sl.payload }}" />
					<input type="button" value="Upload Image" v-on:click="setImage($index)" />
					<input type="button" value="remove"  v-on:click="removeEntry($index)"/>

					</br>Link: 
					<input type="text" size="36" name='home_slides[{{ $index }}][link]' value="{{ sl.link }}" />					

					</br>Blurb: 
					<input type="text" size="36" name='home_slides[{{ $index }}][blurb]' value="{{ sl.blurb }}" />
				</div>
	        	<div><a v-on:click="addEntry()" href="#">add Slide</a></div>
	        </div>
	         
        <?php

    }

    function home_option_validate($input){
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


function theme_settings()
{
	if (!current_user_can('manage_options'))
    {
      wp_die( 'You do not have sufficient permissions to access this page.');
    }

	?>

	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Theme Options</h2>
	    
	<form action="options.php" method="post" >
		<?php settings_fields('home_slides'); ?>
		<?php do_settings_sections('slide_settings'); ?>
		<?php submit_button(); ?>
	</form>

	<?php
}
?>