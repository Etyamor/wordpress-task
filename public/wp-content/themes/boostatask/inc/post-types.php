<?php

function custom_post_type() {
  $labels = array(
    'name'                => _x( 'Items', 'Post Type General Name', 'boostatask' ),
    'singular_name'       => _x( 'Item', 'Post Type Singular Name', 'boostatask' ),
    'menu_name'           => __( 'Items', 'boostatask' ),
    'parent_item_colon'   => __( 'Parent Item', 'boostatask' ),
    'view_item'           => __( 'View Item', 'boostatask' ),
    'all_items'           => __( 'All Items', 'boostatask' ),
    'add_new_item'        => __( 'Add New Item', 'boostatask' ),
    'add_new'             => __( 'Add New', 'boostatask' ),
    'edit_item'           => __( 'Edit Item', 'boostatask' ),
    'update_item'         => __( 'Update Item', 'boostatask' ),
    'search_items'        => __( 'Search Item', 'boostatask' ),
    'not_found'           => __( 'Not Found', 'boostatask' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'boostatask' ),
  );
  $args = array(
    'label'               => __( 'items', 'boostatask' ),
    'description'         => __( 'Items for sale', 'boostatask' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
    'taxonomies'          => array( 'subjects', 'colors', 'materials', 'sizes' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest'        => true,
  );
  register_post_type( 'items', $args );
}
add_action( 'init', 'custom_post_type', 0 );