<?php get_header();?>
<div class="content-area">
  <main>
    <section class="slide">
      <div class="container">
        <div class="row"><?php motoPressSlider( "home-slider" ) ?></div>
      </div>
    </section>
    <section class="services">
      <div class="container">
        <h1><?php _e( "Our Services", 'learnwp' ); ?></h1>
        <div class="row">
          <div class="col-sm-4">
            <div class="services-item">
              <?php 
             if(is_active_sidebar( 'services-1' )){
              dynamic_sidebar( 'services-1' );
             }
            ?>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="services-item">
              <?php  
             if(is_active_sidebar( 'services-2' )){
              dynamic_sidebar( 'services-2' );
             }
            ?>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="services-item">
              <div class="services-item">
                <?php 
             if(is_active_sidebar( 'services-3' )){
              dynamic_sidebar( 'services-3' );
             }
            ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="middle-area">
      <div class="container">
        <div class="row">
          <aside class="sidebar col-md-4 h-100">
            <!-- Require a file called sidebar-home.php -->
            <?php get_sidebar( 'home' ) ?>
          </aside>
          <div class="news col-md-8">
            <div class="container">
              <h1><?php _e( "Latest News", 'learnwp' ); ?></h1>
              <div class="row">
                <?php 
                // First Loop
                $featured = new WP_Query( 'post_type=post&posts_per_page=1&cat=6,3' );

                // $features->have_posts(), $features->the_post()
                if( $featured->have_posts() ):
                  while( $featured->have_posts() ): $featured->the_post();
                  ?>
                <div class="col-12">
                  <?php get_template_part( 'template-parts/content', 'featured' ); ?>
                </div>

                <?php 
                  endwhile;
                  wp_reset_postdata();
                endif;
                
                // Second Loop
                $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => 2,
                  'category__not_in' => array( 4 ),
                  'category__in' => array( 3, 6 ),
                  'offset' => 1 // Skips the first news to avoid duplication (1st news is displayed in the first loop above)
                ); 
                $secondary = new WP_Query(  $args );

                // $features->have_posts(), $features->the_post()
                if( $secondary->have_posts() ):
                  while( $secondary->have_posts() ): $secondary->the_post();
                  ?>
                <div class="col-sm-6">
                  <?php get_template_part( 'template-parts/content', 'secondary' ); ?>
                </div>

                <?php 
                  endwhile;
                  wp_reset_postdata();
                endif;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="map">
      <?php 
      $key = get_theme_mod( 'set_map_apikey' );
      $address = urlencode( get_theme_mod( 'set_map_address' ) );
      ?>

      <iframe width="100%" height="350" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/place?key=<?php echo $key; ?>&q=<?php echo $address; ?>&zoom=15"
        allowfullscreen>
      </iframe>
    </section>
  </main>
</div>
<?php get_footer();?>
<!-- apikey: AIzaSyBkLH3oQi-c2G73uMcvqsMmLMda4pwA7d4 -->