<?php 

function theme_customize_register($wp_customize)
{

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'twentysixteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'twentysixteen_customize_partial_blogdescription',
		) );
	}


	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );


}
add_action( 'customize_register', 'theme_customize_register', 11 );



/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_customize_preview_js() {
	wp_enqueue_script( 'twentysixteen-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'twentysixteen_customize_preview_js' );



function theme_link_color(){
	$link_color = get_theme_mod( 'link_color', '#1a1a1a' );

	$css = '
		.main-post-body .title>a {
			color: %1$s !important;
		}
	';
	wp_add_inline_style( 'theme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'theme_link_color', 11 );

?>