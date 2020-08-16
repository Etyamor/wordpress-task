<?php

function spamTaxSubjects() {
  for($i = 1; $i <= 25; $i++) {
    $tax_ids = wp_insert_term(
      't'.$i,
      'subjects'
    );
    if (!($tax_ids instanceof WP_Error)) {
      $tax_id = $tax_ids['term_id'];
      //set true/false fields
      update_field('is_popular', rand(0,1), 'term_'.$tax_id);
      update_field('dont_display_on_sidebar', rand(0,1), 'term_'.$tax_id);
      //set multiselect field
      $input = array("1", "2", "3", "4", "5");
      $rand_keys = array_rand($input, rand(1,5));
      update_field('specialization', $rand_keys, 'term_'.$tax_id);
    }
  }
}