<?php

add_action( 'customize_register', '__return_true' );


add_action( 'wp_enqueue_scripts', function() {
	// wp_dequeue_style( 'wp-block-library' );
	// wp_dequeue_style( 'wp-block-library-theme' );
	// wp_dequeue_style( 'global-styles' );
}, 99999999 );

add_action( 'after_setup_theme', function() {
	add_theme_support( 'bootstrap' );

	add_theme_support( 'editor-styles' );
	// add_theme_support( 'wp-block-styles' );
	
	add_editor_style( get_template_directory_uri() . '/public/main.css' );

	// Add custom logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 80,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array(
			'site-title',
			'site-description'
		),
		'unlink-homepage-logo' => true
	));
} ); 

add_action( 'wp_enqueue_scripts', function() {
	// wp_enqueue_style(
	// 	'siteblock-vendor',
  //   get_template_directory_uri() . '/public/vendor.css',
	// 	array(),
	// 	wp_get_theme()->get( 'Version' )
	// );

	wp_enqueue_script(
		'siteblock-vendor',
		get_template_directory_uri() . '/public/vendor.js',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'siteblock-main',
    get_template_directory_uri() . '/public/main.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'siteblock-main',
		get_template_directory_uri() . '/public/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
});


function get_custom_logo_callback( $html ) {
	if ( has_custom_logo() ) {
			return $html;
	} else {
			return '<h3>Logo</h3>';
	}
}

/**
 * Enqueues editor UI styles.
 */
// add_action( 'enqueue_block_editor_assets', function() {

// 	// Enqueue editor UI style.
// 	wp_enqueue_style( 'siteblock-main-editor', get_template_directory_uri() . '/public/main.css');
// } );


add_action( 'enqueue_block_assets', function() {
	wp_enqueue_style( 'siteblock-main', get_template_directory_uri() . '/public/main.css' );
}, 0 );