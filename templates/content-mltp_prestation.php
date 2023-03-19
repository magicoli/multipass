<?php
/**
 * Alter content block for MultiPass Prestation post types.
 *
 * Available ariables
 * @param  object $wp_query
 * @param  string $content          original content
 * @param  string post_name         post slug
 * @param  string post_types        post type
 * @param  string $template_slug    this file slug basename
 * @return void                     output directly
 */

// ALter content from here

$content = "<pre>Begin content</pre>" . $content . "<pre>End content</pre>";

// end alter content

/**
 * Output result
 */
echo $content;
