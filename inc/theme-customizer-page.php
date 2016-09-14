<?php

    //add the admin options
    function gray_admin_menu()
    {
        add_theme_page('gray home page', 'Theme Options', 'read', 'home', 'theme_settings');

    }
    add_action('admin_menu','gray_admin_menu');


    
    function gray_home_init(){
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_script( 'vue',  get_template_directory_uri() ."/js/vue/vue.min.js",'1');

        register_setting( 'home_slides', 'home_slides','validate_slides');
        register_setting( 'global_css', 'global_css');


        add_settings_section('slide_section', 'Slides', 'slide_section', 'slide_settings');
        add_settings_field('slides_field', 'Slides', 'slide_field', 'slide_settings', 'slide_section');

        add_settings_section('css_section', 'Global CSS', 'css_section', 'slide_settings');

    }
    add_action('admin_init', 'gray_home_init');

    function css_section(){
          $options = get_option("global_css");
        ?>
           <textarea rows="10" type="text" size="36" name='global_css' style="width:100%;" ><?php echo $options;?></textarea>
        
        <?php
    }

    

    function slide_section() {
        ?>
      <div>Note: A single slide will be viewed without a carousel </div>
      <?php
    } 

    function slide_field() {
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
                    <input type="button" class="button button-primary" value="Upload Image" v-on:click="setImage($index)" />
                    <input type="button" class="button button-primary" value="remove"  v-on:click="removeEntry($index)"/>

                    </br>Link: 
                    <input type="text" size="36" name='home_slides[{{ $index }}][link]' value="{{ sl.link }}" />                    

                    </br>Blurb: 
                    <input type="text" size="36" name='home_slides[{{ $index }}][blurb]' value="{{ sl.blurb }}" />
                </div>
                <div><a v-on:click="addEntry()" style="margin-top:10px;" class="button button-primary" href="#">add Slide</a></div>
            </div>
             

             <script type="text/javascript">
                var slideOptions = new Vue({
                  el: '#slide_options',
                  data:{
                    <?php if(isset($options) && is_array($options)):?>
                        slides : <?php echo json_encode($options); ?>
                    <?php else: ?>
                        slides : []
                    <?php endif; ?>
                  },
                  methods: {
                    addEntry: function(){
                      if(  typeof this.slides !== "object")
                            this.slides = [];
                        this.slides.push({
                            payload:"",
                            link:"",
                            blurb: ""
                        });
                    },
                    removeEntry: function(index){
                        this.slides.splice(index,1);

                    },
                    setImage:function(index){

                      var temp = this.slides[index];
                        window.send_to_editor = function(html) {
                        imgurl = jQuery(html).attr('src');
                        temp.payload = imgurl;
                        tb_remove();
                      }

                      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

                    }

                  }
                });
            </script>

        <?php

    }

    function validate_slides($input){
        if(!is_array($input))
            $input = [];


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
         <?php settings_fields('global_css'); ?>
        <?php do_settings_sections('slide_settings'); ?>
        <?php submit_button(); ?>
    </form>

    <?php
}
?>