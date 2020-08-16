<?php

add_filter('gutenberg_can_edit_post_type', '__return_false');

function boostatask_theme_enqueue() {
  wp_enqueue_style( 'bootstrap-styles', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2');

  wp_enqueue_style( 'stars-styles', 'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css', array(), true);

  wp_enqueue_style( 'main-styles', get_stylesheet_uri(), array(), true);

  wp_enqueue_script('start-js', 'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js', array('jquery'));

  wp_enqueue_script('main-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery', 'start-js'));

}
add_action('wp_enqueue_scripts', 'boostatask_theme_enqueue');

function SqlForItems() {
  global $wpdb;
  $query = "(SELECT wpm.post_id
FROM `wp_postmeta` AS wpm
LEFT JOIN `wp_postmeta` AS wpm_top
ON (wpm.post_id = wpm_top.post_id)
LEFT JOIN `wp_postmeta` AS wpm_rating
ON (wpm.post_id = wpm_rating.post_id)
LEFT JOIN `wp_postmeta` AS wpm_sale
ON (wpm.post_id = wpm_sale.post_id)
LEFT JOIN `wp_term_relationships` AS wtr2
ON (wpm.post_id = wtr2.object_id)
LEFT JOIN `wp_term_relationships` AS wtr7
ON (wpm.post_id = wtr7.object_id)
LEFT JOIN `wp_term_relationships` AS wtr9
ON (wpm.post_id = wtr9.object_id)
LEFT JOIN `wp_term_relationships` AS wtr
ON (wpm.post_id = wtr.object_id)
LEFT JOIN `wp_termmeta` AS termmeta_sidebar
ON (wtr.term_taxonomy_id = termmeta_sidebar.term_id)
LEFT JOIN `wp_termmeta` AS termmeta_popular
ON (wtr.term_taxonomy_id = termmeta_popular.term_id)
LEFT JOIN `wp_termmeta` AS termmeta_spec
ON (wtr.term_taxonomy_id = termmeta_spec.term_id)
WHERE (wpm.meta_key = 'discount_price' AND wpm.meta_value > '' AND not wpm.meta_value like '%[^0-9]%')
AND (wpm_top.meta_key = 'is_top' AND wpm_top.meta_value = 1)
AND (wpm_rating.meta_key = 'rating')
AND (wpm_sale.meta_key = 'in_sale' AND wpm_sale.meta_value = 0)
AND wtr2.term_taxonomy_id = 2
AND wtr7.term_taxonomy_id = 7
AND wtr9.term_taxonomy_id = 9
AND (termmeta_popular.meta_key = 'dont_display_on_sidebar' AND termmeta_popular.meta_value = 1)
AND (termmeta_sidebar.meta_key = 'is_popular' AND termmeta_sidebar.meta_value = 1)
AND (termmeta_spec.meta_key = 'specialization' AND (termmeta_spec.meta_value LIKE '%\"1\"%' AND termmeta_spec.meta_value LIKE '%\"3\"%' AND termmeta_spec.meta_value LIKE '%\"5\"%'))
GROUP BY wpm.post_id, wpm_rating.meta_value
ORDER BY wpm_rating.meta_value DESC
LIMIT 10)
UNION ALL
(SELECT wpm.post_id
FROM `wp_postmeta` AS wpm
LEFT JOIN `wp_postmeta` AS wpm_top
ON (wpm.post_id = wpm_top.post_id)
LEFT JOIN `wp_postmeta` AS wpm_rating
ON (wpm.post_id = wpm_rating.post_id)
LEFT JOIN `wp_postmeta` AS wpm_sale
ON (wpm.post_id = wpm_sale.post_id)
LEFT JOIN `wp_term_relationships` AS wtr2
ON (wpm.post_id = wtr2.object_id)
LEFT JOIN `wp_term_taxonomy` AS wtr_colors
ON (wtr2.term_taxonomy_id = wtr_colors.term_taxonomy_id)
LEFT JOIN `wp_term_relationships` AS wtr7
ON (wpm.post_id = wtr7.object_id)
LEFT JOIN `wp_term_taxonomy` AS wtr_materials
ON (wtr7.term_taxonomy_id = wtr_materials.term_taxonomy_id)
LEFT JOIN `wp_term_relationships` AS wtr9
ON (wpm.post_id = wtr9.object_id)
LEFT JOIN `wp_term_relationships` AS wtr
ON (wpm.post_id = wtr.object_id)
LEFT JOIN `wp_termmeta` AS termmeta_sidebar
ON (wtr.term_taxonomy_id = termmeta_sidebar.term_id)
LEFT JOIN `wp_termmeta` AS termmeta_popular
ON (wtr.term_taxonomy_id = termmeta_popular.term_id)
LEFT JOIN `wp_termmeta` AS termmeta_spec
ON (wtr.term_taxonomy_id = termmeta_spec.term_id)
WHERE (wpm.meta_key = 'discount_price' AND wpm.meta_value > '' AND not wpm.meta_value like '%[^0-9]%')
AND (wpm_top.meta_key = 'is_top' AND wpm_top.meta_value = 1)
AND (wpm_rating.meta_key = 'rating')
AND (wpm_sale.meta_key = 'in_sale' AND wpm_sale.meta_value = 0)
AND (wtr2.term_taxonomy_id != 2 AND wtr_colors.taxonomy = 'colors')
AND (wtr7.term_taxonomy_id != 7 AND wtr_materials.taxonomy = 'materials')
AND wtr9.term_taxonomy_id = 10
AND (termmeta_popular.meta_key = 'dont_display_on_sidebar' AND termmeta_popular.meta_value = 1)
AND (termmeta_sidebar.meta_key = 'is_popular' AND termmeta_sidebar.meta_value = 1)
AND (termmeta_spec.meta_key = 'specialization' AND (termmeta_spec.meta_value LIKE '%\"2\"%' AND termmeta_spec.meta_value LIKE '%\"4\"%'))
GROUP BY wpm.post_id, wpm_rating.meta_value
ORDER BY wpm_rating.meta_value DESC
LIMIT 5)";

  return $wpdb->get_col($query);
}

function loadmore_ajax_handler(){

  global $wp_query;

  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1;
  $args['post_status'] = 'publish';
  query_posts( $args );
  if($wp_query->have_posts()) {
    while($wp_query->have_posts()) {
      the_post();
      get_template_part( 'parts/post-article');
    }
  }
  die;
}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler');

function orderby_ajax_handler(){
  get_template_part( 'parts/post-section');
  die;
}

add_action('wp_ajax_orderby', 'orderby_ajax_handler');
add_action('wp_ajax_nopriv_orderby', 'orderby_ajax_handler');

function add_query_vars_filter( $vars ) {
  $vars[] = "subjects";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );