<?php
/**
 * Alter content block for MultiPass Prestation post types.
 *
 * Available ariables
 *
 * @param  object $wp_query
 * @param  string $content          original content
 * @param  string post_name         post slug
 * @param  string post_types        post type
 * @param  string $template_slug    this file slug basename
 * @return void                     output directly
 */

// ALter content from here

$prestation = new Mltp_Prestation( get_the_ID() );

$content = $content
. $prestation->full_title()
// . MultiPass::format_date_range( $prestation->dates )
 . '<pre>' . print_r( $prestation, true ) . '</pre>';


// end alter content

/**
 * Output result
 */
echo $content;
