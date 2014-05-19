


( function( jQuery ) {
    var x  = wp;
    wp.customize('gray_gradient_one',function(value) {
        value.bind(function(to){
            color_one = to;
            UpdateBackground();
        });
    });

     wp.customize('gray_gradient_two',function( value ) {
        value.bind(function(to){
            color_two = to;
            UpdateBackground();
        });
    });

     wp.customize('gray_pattern_repeat',function( value ) {
        value.bind(function(to){
            background_image = to;
            UpdateBackground();
        });
     });

     wp.customize('gray_cover_background_image',function( value ) {
        value.bind(function(to){
            cover_background_image = to;
            UpdateBackground();
        });
     });

      wp.customize('blogname',function( value ) {
        value.bind(function(to){
            jQuery("#title a").html(to);

        });
     });

       wp.customize('blogdescription',function( value ) {
        value.bind(function(to){
            jQuery("#title .description").html(to);
        });
     });

    wp.customize('header_textcolor',function( value ) {
        value.bind(function(to){
            jQuery("#title a").css("color",to);
        });
     });

   

} )( jQuery )

function UpdateBackground()
{

    if(cover_background_image=== "")
    {
    jQuery('body').css("background",color_one)
    .css("background","url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMxOTU4YTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjMDAxYTZiIiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+)")
    .css("background","url(\""+background_image+"\") repeat top left,-moz-radial-gradient(center, ellipse cover,  "+color_one+" 0%, "+color_two+" 100%)")
    .css("background","url(\""+background_image+"\") repeat top left,-webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,"+color_one+"), color-stop(100%,"+color_two+"))")
    .css("background","url(\""+background_image+"\") repeat top left,-webkit-radial-gradient(center, ellipse cover,  "+color_one+" 0%,"+color_two+" 100%)")
    .css("background","url(\""+background_image+"\") repeat top left,-o-radial-gradient(center, ellipse cover, "+color_one+" 0%,"+color_two+" 100%)")
    .css("background","url(\""+background_image+"\") repeat top left,radial-gradient(ellipse at center, "+color_one+" 0%, "+color_two+" 100%)");
    
    }
    else
    {
        jQuery('body').css("background","url(\""+cover_background_image+"\") center no-repeat fixed");
    }
}
        