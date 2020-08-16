<?php

function spamPostTypeItems()
{
  for ($i = 1; $i <=1000; $i++) {
    $my_post = array(
      'post_title'    => 'Item №' . $i,
      'post_type'     => 'items',
      'post_status'   => 'publish',
      'tax_input' => array(
        'subjects' => genArray('subjects', 5),
        'colors' => genArray('colors', 1),
        'materials' => genArray('materials', 1),
        'sizes' => genArray('sizes', 1),
      )
    );
    $post_id = wp_insert_post($my_post);

    $price = rand(100, 10000);
    $discount = $price*rand(10,90)*0.01; //10-90% possible discount
    update_field('price', $price, $post_id);
    update_field('discount_price', $discount, $post_id);

    $input = array("1", "2", "3", "4", "5");
    $rand_keys = array_rand($input, rand(1,5));
    update_field('type_of_delivery', $rand_keys, $post_id);
    $rand_keys = array_rand($input, rand(1,5));
    update_field('type_of_payment', $rand_keys, $post_id);

    update_field('in_stock', rand(0,1), $post_id);
    update_field('in_sale', rand(0,1), $post_id);
    update_field('is_new', rand(0,1), $post_id);
    update_field('is_top', rand(0,1), $post_id);

    update_field('rating', rand(0,100)/10, $post_id);

    set_post_thumbnail($post_id, rand(294,298)); //id of images
  }
}

function genArray($tax, $max_count)
{
  $terms = get_terms(array(
    'taxonomy' => $tax,
    'hide_empty' => false,
  ));
  $term_ids = array();
  foreach ($terms as $term) {
    array_push($term_ids, $term->term_id);
  }
  $rand_subjects_key_arr = array_rand($term_ids, rand(1, $max_count));
  $rand_subjects_arr = array();
  if(is_array($rand_subjects_key_arr)) {
    foreach ($term_ids as $key => $value) {
      if (in_array($key, $rand_subjects_key_arr)) {
        array_push($rand_subjects_arr, $value);
      }
    }
  } else {
    $rand_subjects_arr = array($term_ids[$rand_subjects_key_arr]);
  }
  return $rand_subjects_arr;
}