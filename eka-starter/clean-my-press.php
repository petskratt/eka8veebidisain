<?php

// vulnerabilities kill, updates may hurt - but make you stronger

add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );

// no comments / ej kommentaari!

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// xml's dead baby, xml's is dead

add_filter( 'xmlrpc_enabled', '__return_false' );

add_filter( 'wp_headers', 'clnr_disable_x_pingback' );

function clnr_disable_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );

	return $headers;
}

add_action( 'after_setup_theme', 'clnr_head_cleanup' );

function clnr_head_cleanup() {

	add_theme_support( 'automatic-feed-links' );
	add_filter( 'feed_links_show_comments_feed', '__return_false' );

	remove_action( 'wp_head', 'feed_links_extra', 3 ); // extra feeds such as category feeds
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );

}


// rest in pieces

remove_action( 'template_redirect', 'rest_output_link_header', 11 );

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );

add_filter( 'rest_authentication_errors', 'clnr_disable_wp_rest_api' );

function clnr_disable_wp_rest_api( $access ) {

	if ( ! is_user_logged_in() ) {

		$message = apply_filters( 'disable_wp_rest_api_error', __( 'REST API restricted to authenticated users.', 'disable-wp-rest-api' ) );

		return new WP_Error( 'rest_login_required', $message, array( 'status' => rest_authorization_required_code() ) );

	}

	return $access;

}

// we didn't have emotions; now we don't have emoticons either

function clnr_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'init', 'clnr_disable_emojis' );