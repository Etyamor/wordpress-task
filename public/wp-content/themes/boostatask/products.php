<?php
get_header();
/* Template Name: Products Page */ ?>

<?php
$query = new WP_Query(array(
  'posts_per_page' => 15,
  'post_type'      => 'items',
  'post__in'       => SqlForItems(),
  'orderby'        => 'post__in'
));
if($query->have_posts()) {
?>

<section id="top15">
    <div class="container">
        <h1 class="text-center">Top 15 Products</h1>
        <div class="row">
          <?php while($query->have_posts()) {
              $query->the_post();
              get_template_part('parts/post-article');
          }
          wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php } ?>

<section id="sorting" class="pb-0">
    <div class="container">
        Sort By
        <select name="orderby">
            <option value="default">Default</option>
            <option value="pricelowtohigh">Price (Low to High)</option>
            <option value="pricehightolow">Price (High to Low)</option>
            <option value="rating">Rating</option>
            <option value="newest">New First</option>
            <option value="topest">Top First</option>
            <option value="popularity">Popularity</option>
        </select>
    </div>
</section>

<div class="container">
    <div class="row">
        <div id="filters" class="col-2">
            <h3>Filters</h3>
            <form id="filter-form" action="orderby" method="GET">
            <h4>Subjects:</h4>
              <?php $terms = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'subjects'
              ));
              foreach ($terms as $term) {
                $checked = (isset($_GET) && isset($_GET['subjects']) && $_GET['subjects'] == $term->term_id) ? 'checked="checked"' : '';
                echo '<label>'.$term->name.'<input type="radio" name="subjects" value="'.$term->term_id.'" '.$checked.'></label>';
              }
              ?>
            <h4>Colors:</h4>
              <?php $terms = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'colors'
              ));
              foreach ($terms as $term) {
                $checked = (isset($_GET) && isset($_GET['colors']) && $_GET['colors'] == $term->term_id) ? 'checked="checked"' : '';
                echo '<label class="d-block">'.$term->name.'<input type="radio" name="colors" value="'.$term->term_id.'" '.$checked.'></label>';
              }
              ?>
            <h4>Materials:</h4>
              <?php $terms = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'materials'
              ));
              foreach ($terms as $term) {
                $checked = (isset($_GET) && isset($_GET['materials']) && $_GET['materials'] == $term->term_id) ? 'checked="checked"' : '';
                echo '<label class="d-block">'.$term->name.'<input type="radio" name="materials" value="'.$term->term_id.'" '.$checked.'></label>';
              }
              ?>
            <h4>Sizes:</h4>
              <?php $terms = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'sizes'
              ));
              foreach ($terms as $term) {
                $checked = (isset($_GET) && isset($_GET['sizes']) && $_GET['sizes'] == $term->term_id) ? 'checked="checked"' : '';
                echo '<label class="d-block">'.$term->name.'<input type="radio" name="sizes" value="'.$term->term_id.'" '.$checked.'></label>';
              }
              ?>
            </form>
        </div>
        <div id="posts" class="col-8">
            <?php get_template_part('parts/post-section') ?>
        </div>
    </div>
</div>

<?php get_footer() ?>