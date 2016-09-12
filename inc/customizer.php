<?php 

function theme_customize_register($wp_customize)
{

	
	// Remove the core header textcolor control, as it shares the main text color.
	//$wp_customize->remove_control( 'header_textcolor' );

	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#2199e8',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'theme' ),
		'section'     => 'colors',
	)));

	// Add link color setting and control.
	$wp_customize->add_setting( 'secondary_link_color', array(
		'default'           => '#2199e8',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_link_color', array(
		'label'       => __( 'Secondary Link Color', 'theme' ),
		'section'     => 'colors',
	)));

	// Add link color setting and control.
	$wp_customize->add_setting( 'body_background_color', array(
		'default'           => '#fefefe',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background_color', array(
		'label'       => __( 'Background Color', 'theme' ),
		'section'     => 'colors',
	)));


	// Add link color setting and control.
	$wp_customize->add_setting( 'foreground_color', array(
		'default'           => '#ececec',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'foreground_color', array(
		'label'       => __( 'Foreground Color', 'theme' ),
		'section'     => 'colors',
	)));



}
add_action( 'customize_register', 'theme_customize_register', 11 );


function theme_link_color(){
	$link_color = get_theme_mod( 'link_color', '#2199e8' );

	$css = '
		.main-post-body .title>a {
			color: %1$s !important;
		}

		.widget ul li a{
			color: %1$s !important;
		}

		.top-bar ul li>a{
			color: %1$s !important;
		}

		.button{
			background: %1$s !important;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_link_color', 11 );


function theme_secondary_link_color(){
	$link_color = get_theme_mod( 'secondary_link_color', '#2199e8' );

	$css = '
		.main-post-body .author>a {
			color: %1$s !important;
		}

		.postmetadata>a {
			color: %1$s !important;
		}

		.main-post-body a {
		    color: %1$s;
		}

	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_secondary_link_color', 11 );



function theme_body_background_color(){
	$link_color = get_theme_mod( 'body_background_color', '#fefefe' );

	$css = '
		body.customize-support, body.home{
			background: %1$s ;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_body_background_color', 11 );


function theme_foreground_color(){
	$link_color = get_theme_mod( 'foreground_color', '#ececec' );
	$rgb = theme_hex2rgb($link_color);

	$primary = rgbToHsl($rgb[0],$rgb[1],$rgb[2]);
	$primary[2] = $primary[2] + -.1;

	$secondary = rgbToHsl($rgb[0],$rgb[1],$rgb[2]);
	$secondary[2] = $secondary[2] + -.2;

	
	$tertiary = rgbToHsl($rgb[0],$rgb[1],$rgb[2]);
	$tertiary[2] = $tertiary[2] + -.5;


	$css = '
		.post, .type-page, .type-attachment, .post-box{
			background: %1$s !important;
			box-shadow: 1px 1px %3$s !important;
		}

		table tbody{
			 border-color: %2$s !important;	
		}
		table tbody tr:nth-child(odd) {
		    background-color: %3$s !important;
		    border-color: %2$s !important;
		}

		table tbody tr:nth-child(even) {
		    background-color: %2$s !important;
		    border-color: %2$s !important;
		}

		table thead{
			background-color: %2$s !important;
			border-color: %2$s !important;
		}

		kbd{
			background-color: %2$s !important;
		}

		code{
			background-color: %2$s !important;
			border-color: %3$s !important;
		}

		.featured{
			background-color: %4$s !important;
		}


		.sub-menu {
		    background-color: %1$s !important;
		}


		blockquote, blockquote p {
		    color: %4$s !important;
		}
		blockquote{
			border-color:%4$s !important;
		}

		cite{
			color:%4$s !important;
		}


		
	';
	wp_add_inline_style( 'theme-style', sprintf( $css,$link_color,
		rgb2hex(hslToRgb($primary[0],$primary[1],$primary[2])),
		rgb2hex(hslToRgb($secondary[0],$secondary[1],$secondary[2])),
		rgb2hex(hslToRgb($tertiary[0],$tertiary[1],$tertiary[2]))));
}
add_action( 'wp_enqueue_scripts', 'theme_foreground_color', 11 );





function theme_header_color(){
	$link_color = get_theme_mod( 'header_textcolor', '#2199e8' );

	$css = '
		.header-title>a {
			color: #%1$s !important;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_header_color', 11 );


?>