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
		body.customize-support{
			background: %1$s ;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_body_background_color', 11 );


function theme_foreground_color(){
	$link_color = get_theme_mod( 'foreground_color', '#ececec' );

	$css = '
		.post, .type-page, .type-attachment, .post-box{
			background: %1$s !important;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
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