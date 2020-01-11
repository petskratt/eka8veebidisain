<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>
<body>

<div class="hero-bg">
    <div class="slanted-bg">

        <header class="container-fluid">
            <div class="row bg-semi-dark text-center top-bar d-none d-md-flex">
                <div class="col-12 col-md-4">
	                <?php dynamic_sidebar( 'top-left' ); ?>
                </div>
                <div class="col-12 col-md-4">
	                <?php dynamic_sidebar( 'top-center' ); ?>
                </div>
                <div class="col-12 col-md-4">
	                <?php dynamic_sidebar( 'top-right' ); ?>
                </div>
            </div>
            <div class="row bg-light">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="/"><img src="<?= get_template_directory_uri(); ?>/assets/odium_logo.svg" alt="Odiumi logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

	                    <?php
	                    wp_nav_menu([
		                    'menu'            => 'primary',
		                    'theme_location'  => 'primary',
		                    'container'       => 'div',
		                    'container_id'    => 'bs4navbar',
		                    'container_class' => 'collapse navbar-collapse',
		                    'menu_id'         => false,
		                    'menu_class'      => 'navbar-nav ml-auto',
		                    'depth'           => 2,
		                    'fallback_cb'     => 'bs4navwalker::fallback',
		                    'walker'          => new bs4navwalker()
	                    ]);
	                    ?>

                        <a href="#" class="btn btn-outline-danger my-2 my-sm-0">e-Odium</a>


                    </nav>
                </div>
            </div>