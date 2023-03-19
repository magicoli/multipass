<?php if ( ! defined( 'WPINC' ) ) die;

function multipass_find_template( $choices = [], $fallback = null ) {
  if (is_string($choices)) $choices = [ $choices ];

  $directories = array_unique( array(
    get_template_directory() . '/templates',
    dirname( __DIR__ ) . "/templates",
  ) );

  if ( is_array($choices) ) {
    foreach($choices as $choice) {
      foreach ( $directories as $dir ) {
        if(file_exists("$dir/$choice")) {
          return "$dir/$choice";
        }
      }
    }
  }

  return $fallback;
}

add_action( 'template_include', 'multipass_template_include' );
function multipass_template_include( $template ) {
  global $wp_query, $wp;
  $plugindir = dirname( __DIR__ );
  $post_name = (isset($wp_query->queried_object->post_name)) ? $wp_query->queried_object->post_name : '';
  $template_slug=str_replace('/^index$/', 'archive', str_replace('.php', '', basename($template)));
  $post_id = get_the_ID();
  $post_type_slug=get_post_type();

  $choices = array(
    // ( $condition === true ) ? "$plugindir/templates/$template_slug-splash.php" : NULL,
    "$template_slug-$post_type_slug.php",
    // "$plugindir/templates/$template_slug.php", // We should probably not override generic templates
  );

  return multipass_find_template( $choices, $template);
}

add_filter( 'the_content', 'multipass_the_content');
function multipass_the_content ( $content ) {
  global $wp_query;
  global $template;
  if(function_exists('wc_print_notices')) wc_print_notices();
  $plugindir = dirname( __DIR__ );
  $post_type_slug=get_post_type();
  $post_name = (isset($wp_query->queried_object->post_name)) ? $wp_query->queried_object->post_name : '';
  $template_slug=str_replace('.php', '', basename($template));
  $choices = array_filter ( array(
    (empty($post_name)) ? null : "content-$post_type_slug-$template_slug-$post_name.php",
    (empty($post_name)) ? null : "content-$post_type_slug--$post_name.php",
    "content-$post_type_slug-$template_slug.php",
    "content-$post_type_slug.php",
  ) );
  $custom_template = multipass_find_template( $choices );

  if( ! empty($custom_template) &&  file_exists($custom_template) ) {
    $template_slug = basename($custom_template, ".php");

    ob_start();
    include $custom_template;
    $custom_template_content = ob_get_clean();
    $content = "<div class='multipass content $post_type_slug $template_slug'>$custom_template_content</div>";
  }
  $content = wp_cache_get('multipass_notices') . $content;
  wp_cache_delete('multipass_notices');
  return $content;
}

// add_filter( 'get_the_archive_title', 'multipass_remove_archive_prefix' );
add_filter( 'get_the_archive_title_prefix', 'multipass_remove_archive_prefix' );
function multipass_remove_archive_prefix( $prefix ) {
    if ( is_post_type_archive( array(
      'mltp_detail',
      'mltp_prestation',
      'mltp_resource',
    ) ) ) {
      return false;
        // $title = post_type_archive_title( '', false );
    }
    return $prefix;
}

// /**
//  * Find original post to match special pages translated with WMPL.
//  * Useful when templates exist for specific pages.
//  *
//  * @param  integer $object_id              post ID
//  * @param  string $type                    post type (default 'post')
//  * @return integer            original post ID if found, false if none found
//  */
// function multipass_original_language_post( $object_id, $type = 'post' ) {
//   if($original_post_id = apply_filters( 'wpml_element_trid', NULL, $object_id, 'post_page' ))
//   return $original_post_id;
//
//   return false;
// }
