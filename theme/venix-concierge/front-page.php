<?php
/**
 * Front page.
 *
 * Derived client themes may replace the content flow with project-specific
 * PHP template parts while preserving the hybrid architecture.
 *
 * @package VenixConcierge
 */

if ( is_home() ) {
	locate_template( 'home.php', true );
	return;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
