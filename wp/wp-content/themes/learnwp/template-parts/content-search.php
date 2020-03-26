<article id="post-<?php the_ID();?>" <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>">
    <h2><?php the_title(); ?></h2>
  </a>

  <div class="meta-info">
    <p>Posted in <?php echo get_the_date(); ?> by <?php the_author_posts_link(); ?></p>
    <?php if( has_category() ): ?>
    <p>Categories: <?php the_category( ' ' ); ?></p>
    <?php endif; ?>
    <p><?php the_tags( 'Tags: ', ', ' ); ?></p>
  </div>

  <p><?php the_excerpt(); ?></p>

</article>