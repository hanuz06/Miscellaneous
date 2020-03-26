<?php 

function learnwp_customizer( $wp_customize ){
  
  // Copyright
  $wp_customize-> add_section( 'sec_copyright', array(
    'title' => 'Copyright',
    'description' =>'Please, type here your copyright'
  ) );

  $wp_customize->add_setting( 'set_copyright', array(
    'type' => 'theme_mod', // In this case it means "only for this theme"
    'default' => 'Copyright X - All Rights Reserved', // Default text like placeholder in input
    'sanitize_callback' => 'esc_attr' // For security
  ) );
  
  $wp_customize->add_control( 'ctrl_copyright', array(
    'label' => 'Copyright Information',
    'description' => 'Please, type your copyright here',
    'section' => 'sec_copyright',
    'settings' => 'set_copyright',
    'type' => 'text'
  ) );

  // Map
  $wp_customize-> add_section( 'sec_map', array(
    'title' => 'Map',
    'description' =>'The Map Section'
  ) );

  // API Key
  $wp_customize->add_setting( 'set_map_apikey', array(
    'type' => 'theme_mod', // In this case it means "only for this theme"
    'default' => '', // Default value is empty as this is an api key that the user will input manually
    'sanitize_callback' => 'esc_attr' // For security
  ) );

  $wp_customize->add_control( 'ctrl_map_apikey', array(
    'label' => 'Google Maps API Key',
    'description' => 'Get your key <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend">here</a>',
    'section' => 'sec_map',
    'settings' => 'set_map_apikey',
    'type' => 'text'
  ) );
  
  // Map Address
  $wp_customize->add_setting( 'set_map_address', array(
    'type' => 'theme_mod', // In this case it means "only for this theme"
    'default' => '', // Default value is empty 
    'sanitize_callback' => 'esc_textarea' // For security
  ) );

  $wp_customize->add_control( 'ctrl_map_address', array(
    'label' => 'Type your address here',
    'description' => 'No special characters allowed',
    'section' => 'sec_map',
    'settings' => 'set_map_address',
    'type' => 'textarea'
  ) );
} 

add_action( 'customize_register', 'learnwp_customizer');