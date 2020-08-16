<?php
get_header();
/* Template Name: Full Width Page */ ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-6">
        <?php echo do_shortcode('[customGallery]') ?>
      </div>
      <div class="col-6">
          <h1>Main Info:</h1>
        <?php the_post_thumbnail(); ?>
        <p>Title: <?php the_title() ?></p>
        <div class="rating" data-rating="<?php the_field('rating'); ?>"></div>
        <p>Price: <?php the_field('price') ?></p>
        <p>Discount: <?php the_field('discount_price') ?></p>
      </div>
    </div>
  </div>
</section>

<?php get_footer() ?>