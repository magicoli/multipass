<?php

$page_content = wp_cache_get( 'multipass_notices' );
wp_cache_delete( 'multipass_notices' );

// Build page content from here
$page_content .= '<p>page content built from ' . __FILE__ . '</p>';

// End build page content

echo $page_content;
