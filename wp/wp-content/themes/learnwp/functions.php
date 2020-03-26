<?php
// Requiring Theme Customizer
require get_template_directory() . '/inc/customizer.php';

// Requiring TGM Plugin Activity
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/required-plugins.php';

// Including stylesheet and script files
function load_scripts(){
	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
	wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css', array(), '4.0.0', 'all' );
	wp_enqueue_style( 'template', get_template_directory_uri() . '/css/template.css', array(), rand(111,99999), 'all' );	
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

function learnwp_gutenberg_fonts(){  
	wp_enqueue_style( 'lato-font', 'https://fonts.googleapis.com/css?family=Lato:400,900' );
	wp_enqueue_style( 'oswald-font', 'https://fonts.googleapis.com/css?family=Oswald:200,400,900' );
}
add_action( 'enqueue_block_editor_assets', 'learnwp_gutenberg_fonts' );
// Main configuration function
function learnwp_config(){
  // Registering our menus
  register_nav_menus(
    array( 
      'my_main_menu' => __( 'Main Menu', 'learnwp' ),
      'footer_menu' => __( 'Footer Menu', 'learnwp' )
    )
  ); 

  $args = array(  
    'height' => 225,
    'width' => 1920
  );
  add_theme_support( 'custom-header', $args); // It is in Appearance / Header
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'video', 'image' ) );
  add_theme_support( 'title-tag' );
  add_theme_support( 'custom-logo', array(
    'height' => 110,
    'width' => 200
  ) );
  
  $textdomain = 'learnwp';
  load_theme_textdomain( $textdomain, get_stylesheet_directory() . '/languages/' );
  load_theme_textdomain( $textdomain, get_template_directory() . '/languages/' );

  // Support for Gutenberg features
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Blood Red', 'learnwp' ),
			'slug' => 'blood-red',
			'color' => '#b9121b'
		),
		array(
			'name' => __( 'White Color', 'learnwp' ),
			'slug' => 'white',
			'color' => '#ffffff'
		)		
	) );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/style-editor.css' );
	add_theme_support( 'wp-block-styles' );
  
} 
add_action( 'after_setup_theme', 'learnwp_config', 0 );

// Register our sidebars. It shows we can add action b4 function definition
add_action( 'widgets_init', 'learnwp_sidebars' );
function learnwp_sidebars(){
  register_sidebar(
    array(
      'name' => __( 'Home Page Sidebar', 'learnwp' ),
      'id' => 'sidebar-1',
      'description' => __('This is the Home Page Sidebar. Your can add your widgets here.', 'learnwp'),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    );
  register_sidebar(
    array(
      'name' => __('Blog Sidebar', 'learnwp'),
      'id' => 'sidebar-2',
      'description' => __('This is the Blog Sidebar. Your can add your widgets here.', 'learnwp'),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    );
  register_sidebar(
    array(
      'name' => __( 'Service 1', 'learnwp' ),
      'id' => 'services-1',
      'description' => __( 'First Services Area.', 'learnwp' ),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    );
  register_sidebar(
    array(
      'name' => __( 'Service 2', 'learnwp' ),
      'id' => 'services-2',
      'description' => __( 'Second Services Area.', 'learnwp' ),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    );
  register_sidebar(
    array(
      'name' => __( 'Service 3', 'learnwp' ),
      'id' => 'services-3',
      'description' => __( 'Third Services Area.', 'learnwp' ),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    ); 
  register_sidebar(
    array(
      'name' => __( 'Social Media Icons', 'learnwp' 
       
    ),
      'id' => 'social-media',
      'description' => __( 'Social Media Icons Widget Area. Drag and drop your widgets here.', 'learnwp' ),
      'before_widget' => '<div class="widget-wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',      
    )
    ); 
}