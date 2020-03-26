<?php get_header();?>
<div id="primary">
  <div id="name">
    <div class="container">
      <h2><?php _e( "Search results for:", 'learnwp' ); ?> <?php echo get_search_query();?></h2>

      <?php 
      // Show search results
      get_search_form();
      while( have_posts() ): 
        the_post();
        get_template_part( 'template-parts/content', 'search' );
        
        if( comments_open() || get_comments_number() ):
          comments_template();          
        endif;
         
      endwhile;
      
      // Pagination
      the_posts_pagination(
        array( 
          'screen_reader_text' => 'Navigation',
          'prev_text' => __( 'Previous', 'learnwp' ),
          'next_text' => __( 'Next', 'learnwp' )
        )
      );        
      ?>

    </div>
  </div>
</div>
<?php get_footer();?>