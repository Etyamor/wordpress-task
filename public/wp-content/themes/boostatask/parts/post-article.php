<div class="col-3">
  <article>
    <a href="<?php echo get_permalink() ?>">
      <?php the_post_thumbnail(); ?>
    </a>
    <h3><?php the_title(); ?></h3>
    <div class="rating" data-rating="<?php the_field('rating'); ?>"></div>
    <p>Price:
      <?php
      if(get_field('discount_price')) {
        echo '<strike>';
        the_field('price');
        echo '</strike>';
      } else {
        the_field('price');
      }
      ?>
    </p>
    <?php if(get_field('discount_price')) { ?>
      <p>Discount: <?php the_field('discount_price'); ?></p>
    <?php } ?>
  </article>
</div>