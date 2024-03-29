<?php get_header();?>
<img class="img-fluid" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>"
  width="<?php echo get_custom_header()->width; ?>" alt="" />

<div class="content-area">
  <main>
    <section class="middle-area">
      <div class="container">
        <div class="row">
          <div class="error-404">

            <header>
              <h1><?php _e( 'Page not found', 'learnwp' ) ?></h1>
              <p><?php _e( 'Unfortunately, the page you tried to reach does not exist on
                this site!', 'learnwp' ) ?></p>
            </header>

            <div class="error">
              <p><?php _e( 'How about doing a search?', 'learnwp' ) ?></p>
              <?php get_search_form(); ?>
              <?php the_widget( 'WP_Widget_Recent_Posts', array( 'title' => __( 'Latest Posts', 'learnwp' ), 'number' => 3 ) ); ?>

            </div>

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