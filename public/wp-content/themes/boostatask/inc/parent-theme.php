<?php

function parent_theme_enqueue_styles() {
  $parenthandle = 'twentytwenty-style';
  $theme = wp_get_theme();
  wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
    array(),
    $theme->parent()->get('Version')
  );
}
add_action( 'wp_enqueue_scripts', 'parent_theme_enqueue_styles' );