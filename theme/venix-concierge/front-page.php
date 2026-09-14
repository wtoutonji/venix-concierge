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

<?php get_template_part( 'template-parts/sections/home' ); ?>

<?php
get_footer();
