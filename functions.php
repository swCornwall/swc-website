<?php
function my_theme_enqueue_styles() { 
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );

function my_login_logo_url() {
    return 'https://www.softwarecornwall.org';
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title() {
    return 'Welcome to the Cornish Tech Community';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function et_get_footer_credits() {
  $original_footer_credits = et_get_original_footer_credits();

  $disable_custom_credits = et_get_option( 'disable_custom_footer_credits', false );

  if ( $disable_custom_credits ) {
    return '';
  }

  $credits_format = '<%2$s id="footer-info">%1$s</%2$s>';

  $footer_credits = "Copyright &copy; " . date_i18n('Y') . " " . et_get_option( 'custom_footer_credits', '' );

  if ( '' === trim( $footer_credits ) ) {
    return et_get_safe_localization( sprintf( $credits_format, $original_footer_credits, 'p' ) );
  }

  return et_get_safe_localization( sprintf( $credits_format, $footer_credits, 'div' ) );
}
