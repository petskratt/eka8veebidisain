<?php

get_header();

// include 'index.html';

wp_nav_menu(
	array(
		'theme_location' => 'primary'
	)
);

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_date('', "<p><strong>", "</strong> postitused</p>");
		// Displays post content.
		echo "<h1>";
		the_title();
		echo "</h1>";
		the_content();
		echo get_the_date() . ' autor ' . get_the_author();
	endwhile;
endif;

get_footer();