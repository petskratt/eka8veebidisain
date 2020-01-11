<?php

get_header();

// wp_nav_menu( [ 'theme_location' => 'primary' ] );

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		?>
        <div class="container-fluid ">
            <div class="row">
                <div class="container">
                    <div class="row d-none d-md-flex">
                        <div class="col-12 col-lg-10 col-xl-8">
                            <h1><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="row d-md-none">
                        <div class="col-12 col-lg-10 col-xl-8">
                            <h1>Mjäux?</h1>
                            <h5>Korraldame AM, A, A1, A2, B, BE, C, CE- ja D-kat. kassisõbra kursuseid, samuti
                                ametikoolitusi veokassiomanikele ja taksokiisudele ning esmaabi koolitusi eesti,
                                vene ja inglise keeles. Nurr :)</h5>
                        </div>
                    </div>

                </div>

            </div>
        </div>
	<?php
	endwhile;
endif;

get_footer();