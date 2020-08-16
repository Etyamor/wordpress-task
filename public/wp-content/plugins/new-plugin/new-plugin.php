<?php

/*
Plugin Name: custom gallery
Text Domain: custom-gallery
*/

if (!defined('ABSPATH')) exit;

acf_add_local_field_group(array(
  'key' => 'custom_gallery',
  'title' => 'Custom Gallery',
  'fields' => array (
    array (
      'key' => 'gallery_1',
      'label' => 'Gallery',
      'name' => 'gallery',
      'type' => 'gallery',
      'return_format' => 'id'
    )
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'items',
      ),
    ),
  ),
));

function customGallery(){
  include dirname( __FILE__ ) . '/assets/gallery.php';
}
add_shortcode('customGallery', 'customGallery');

function plugin_styles() {
  wp_enqueue_style( 'gal-css1', plugin_dir_url( __FILE__ ) . 'assets/photoswipe/photoswipe.css', array(), true);
  wp_enqueue_style( 'gal-css2', plugin_dir_url( __FILE__ ) . 'assets/photoswipe/default-skin/default-skin.css', array(), true);
  wp_enqueue_script('gal-js1', plugin_dir_url( __FILE__ ) . 'assets/photoswipe/photoswipe.min.js', array('jquery'));
  wp_enqueue_script('gal-js2', plugin_dir_url( __FILE__ ) . 'assets/photoswipe/photoswipe-ui-default.min.js', array('jquery'));
  wp_enqueue_script('gal-js3', plugin_dir_url( __FILE__ ) . 'assets/js.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'plugin_styles');