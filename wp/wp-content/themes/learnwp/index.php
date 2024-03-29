<?php get_header();?>
<img class="img-fluid" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>"
  width="<?php echo get_custom_header()->width; ?>" alt="" />

<div class="content-area">
  <main>
    <section class="middle-area">
      <div class="container">
        <div class="row">
          <div class="news col-md-9">

            <?php 
            // If there are any posts
              if(have_posts()):
                // While have posts, show them to us
                while(have_posts()): the_post();     
                
                get_template_part( 'template-parts/content', get_post_format() ); 
                           
              endwhile;
            ?>

            <!-- Pagination -->
            <div class="row">
              <div class="pages col-6 text-left">
                <?php previous_posts_link (__( "<< Newer posts", 'learnwp' ) ); ?>
              </div>
              <div class="pages col-6 text-right">
                <?php next_posts_link (__( "Older posts >>", 'learnwp' ) ); ?>
              </div>
            </div>

            <?php
            else:
            ?>

            <p><?php _e( 'There&rsquo;s nothing yet to be displayed', 'learnwp' ) ?></p>

            <?php endif; ?>

          </div>
          <aside class="sidebar col-md-3 h-100"> <?php get_sidebar( 'blog') ?> </aside>
        </div>
      </div>
    </section>
    <section class="map">
      <div class="container">
        <div class="row"> Map </div>
      </div>
    </section>
  </main>
</div>
<?php get_footer();?>