<?php

require_once 'clean-my-press.php';
require_once 'bs4navwalker.php';

add_action( 'wp_enqueue_scripts', 'eka_enqueue_scripts' );


function eka_enqueue_scripts() {

	$theme = wp_get_theme();

	// properly enqueue external css:

	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', [], '1.0.0' );

	// theme's css, after Bootstrap

	wp_enqueue_style( 'style', get_stylesheet_uri(), [ 'bootstrap' ], $theme->get( 'Version' ) );

	// scripts
	wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js"', [], $theme->get( 'Version' ), true );
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [ 'jquery' ], $theme->get( 'Version' ), true );
	wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', [
		'popper',
		'jquery'
	], $theme->get( 'Version' ), true );
}


// let WordPress know we'll have one menu location

add_action( 'init', 'eka_register_my_menus' );

function eka_register_my_menus() {
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Header Menu', 'starter' ),
		)
	);
}

// this is just a silly function that randomly capitalizes the_content()

//add_filter( 'the_content', 'eka_random' );

function eka_random( $content ) {

	$str = $content;

	for ( $i = 0, $c = strlen( $str ); $i < $c; $i ++ ) {
		$str[ $i ] = rand( 0, 100 ) > 50 ? strtoupper( $str[ $i ] ) : $str[ $i ];
	}

	return $str;
}

// let WP generate <title> tag in wp_head()

function eka_setup() {
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'eka_setup' );


function eka_widgets_init() {

	register_sidebar( [
			'name' => 'Top left',
			'id' => 'top-left',
			'before_widget' => '',
			'after_widget'  => '',
		]
	);

	register_sidebar( [
			'name' => 'Top center',
			'id' => 'top-center',
			'before_widget' => '',
			'after_widget'  => '',
		]
	);

	register_sidebar( [
			'name' => 'Top right',
			'id' => 'top-right',
			'before_widget' => '',
			'after_widget'  => '',
		]
	);

}

add_action( 'widgets_init', 'eka_widgets_init' );