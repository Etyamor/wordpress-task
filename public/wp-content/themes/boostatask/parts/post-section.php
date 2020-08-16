<?php

function filterItemsByGetParameters() {

    if(!isset($_GET)){
        return array();
    }
    $get = $_GET;

    $orderArr = array();
    $filterTaxArr = array();

    foreach ($get as $key => $param) {
        if($key == 'orderby') {
            switch($param) {
              case 'default':
                $orderArr = array();
                break;
              case 'pricelowtohigh':
                  $orderArr = array(
                    'meta_key' => 'price',
                    'orderby'  => 'meta_value_num',
                    'order'    => 'ASC'
                  );
                  break;
              case 'pricehightolow':
                $orderArr = array(
                  'meta_key' => 'price',
                  'orderby'  => 'meta_value_num',
                  'order'    => 'DESC'
                );
                break;
              case 'rating':
                $orderArr = array(
                  'meta_key' => 'rating',
                  'orderby'  => 'meta_value_num',
                  'order'    => 'DESC'
                );
                break;
              case 'newest':
                $orderArr = array(
                  'meta_key' => 'is_new',
                  'orderby'  => 'meta_value_num',
                  'order'    => 'DESC'
                );
                break;
              case 'topest':
                $orderArr = array(
                  'meta_key' => 'is_top',
                  'orderby'  => 'meta_value_num',
                  'order'    => 'DESC'
                );
                break;
              case 'popularity':
                $popterms = get_terms(array(
                  'hide_empty' => false,
                  'taxonomy' => 'subjects',
                  'meta_query' => array(
                    array(
                      'key'       => 'is_popular',
                      'value'     => '1',
                      'compare'   => '='
                    )
                  ),
                ));
                $poptermsArr = array();
                foreach ($popterms as $term) {
                    array_push($poptermsArr, $term->term_id);
                }
                $orderArr = array(
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'subjects',
                      'field'    => 'term_id',
                      'terms'    => $poptermsArr,
                    )
                  ),
                );
                break;
            }
        }
        if($key == 'subjects' || $key == 'colors' || $key == 'materials' || $key == 'sizes') {
            array_push($filterTaxArr, array(
              'taxonomy' => $key,
              'field'    => 'id',
              'terms'    => array($param),
            ));
        }
    }

    if(count($filterTaxArr)) {
      $filterTaxArr['relation'] = 'AND';
      $filterTaxArr = array('tax_query' => $filterTaxArr);
    }

    $result = array_merge($orderArr, $filterTaxArr);

    return isset($result) ? $result : array();
}


global $wp_query;
$wp_query_backup = $wp_query;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
  'paged'          => $paged,
  'posts_per_page' => 15,
  'post_type'      => 'items',
  'post__not_in'   => SqlForItems(),
);
$args = array_merge($args, filterItemsByGetParameters());
$wp_query = new WP_Query($args);
if(have_posts()) {
  ?>

  <section id="items" class="pt-1">
    <div class="container">
      <h1 class="text-center">Other Products. Pages: <?php echo $wp_query->max_num_pages ?></h1>
      <div class="row">
        <?php while(have_posts()) {
          the_post();
          get_template_part('parts/post-article');
        }
        wp_reset_postdata(); ?>
      </div>
      <?php if($wp_query->max_num_pages > 1) { ?>
        <a class="d-block text-center" style="font-size: 24px" id="load_more">Load More</a>
      <?php } ?>
    </div>
    <script>
        var loadmore_params = {
            "ajaxurl": "<?php echo site_url() . '/wp-admin/admin-ajax.php' ?>",
            "posts": '<?php echo json_encode( $wp_query->query_vars ) ?>',
            "current_page": "<?php echo $paged ?>",
            "max_page": "<?php echo $wp_query->max_num_pages ?>"
        };
    </script>
  </section>

<?php } $wp_query = $wp_query_backup ?>