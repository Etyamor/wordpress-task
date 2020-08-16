<?php

function taxonomies() {
  $labels = array(
    'name'              => _x( 'Subjects', 'taxonomy general name', 'boostatask' ),
    'singular_name'     => _x( 'Subject', 'taxonomy singular name', 'boostatask' ),
    'search_items'      => __( 'Search Subject', 'boostatask' ),
    'all_items'         => __( 'All Subjects', 'boostatask' ),
    'parent_item'       => __( 'Parent Subject', 'boostatask' ),
    'parent_item_colon' => __( 'Parent Subject:', 'boostatask' ),
    'edit_item'         => __( 'Edit Subject', 'boostatask' ),
    'update_item'       => __( 'Update Subject', 'boostatask' ),
    'add_new_item'      => __( 'Add New Subject', 'boostatask' ),
    'new_item_name'     => __( 'New Subject Name', 'boostatask' ),
    'menu_name'         => __( 'Subject', 'boostatask' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'subjects' ),
  );
  register_taxonomy( 'subjects', array( 'items' ), $args );

  unset($labels);
  unset($args);

  $labels = array(
    'name'              => _x( 'Colors', 'taxonomy general name', 'boostatask' ),
    'singular_name'     => _x( 'Color', 'taxonomy singular name', 'boostatask' ),
    'search_items'      => __( 'Search Color', 'boostatask' ),
    'all_items'         => __( 'All COlors', 'boostatask' ),
    'parent_item'       => __( 'Parent Color', 'boostatask' ),
    'parent_item_colon' => __( 'Parent Color:', 'boostatask' ),
    'edit_item'         => __( 'Edit Color', 'boostatask' ),
    'update_item'       => __( 'Update Color', 'boostatask' ),
    'add_new_item'      => __( 'Add New Color', 'boostatask' ),
    'new_item_name'     => __( 'New Color Name', 'boostatask' ),
    'menu_name'         => __( 'Color', 'boostatask' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'colors' ),
  );
  register_taxonomy( 'colors', array( 'items' ), $args );

  unset($labels);
  unset($args);

  $labels = array(
    'name'              => _x( 'Materials', 'taxonomy general name', 'boostatask' ),
    'singular_name'     => _x( 'Material', 'taxonomy singular name', 'boostatask' ),
    'search_items'      => __( 'Search Material', 'boostatask' ),
    'all_items'         => __( 'All Materials', 'boostatask' ),
    'parent_item'       => __( 'Parent Material', 'boostatask' ),
    'parent_item_colon' => __( 'Parent Material:', 'boostatask' ),
    'edit_item'         => __( 'Edit Material', 'boostatask' ),
    'update_item'       => __( 'Update Material', 'boostatask' ),
    'add_new_item'      => __( 'Add New Material', 'boostatask' ),
    'new_item_name'     => __( 'New Material Name', 'boostatask' ),
    'menu_name'         => __( 'Material', 'boostatask' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'materials' ),
  );
  register_taxonomy( 'materials', array( 'items' ), $args );

  unset($labels);
  unset($args);

  $labels = array(
    'name'              => _x( 'Sizes', 'taxonomy general name', 'boostatask' ),
    'singular_name'     => _x( 'Size', 'taxonomy singular name', 'boostatask' ),
    'search_items'      => __( 'Search Size', 'boostatask' ),
    'all_items'         => __( 'All Sizes', 'boostatask' ),
    'parent_item'       => __( 'Parent Size', 'boostatask' ),
    'parent_item_colon' => __( 'Parent Size:', 'boostatask' ),
    'edit_item'         => __( 'Edit Size', 'boostatask' ),
    'update_item'       => __( 'Update Size', 'boostatask' ),
    'add_new_item'      => __( 'Add New Size', 'boostatask' ),
    'new_item_name'     => __( 'New Size Name', 'boostatask' ),
    'menu_name'         => __( 'Size', 'boostatask' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'sizes' ),
  );
  register_taxonomy( 'sizes', array( 'items' ), $args );
}
add_action( 'init', 'taxonomies', 0 );