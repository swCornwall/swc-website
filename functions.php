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

/**
 * Gravity Wiz // Gravity Forms // Content Template for Post Excerpt Field
 *
 * Gravity Forms does not currently offer a "Content Template" option for the 
 * Excerpt field. This is a simple snippet that allows you to create
 */
// update "433" to the ID of your form

add_filter( 'gform_post_data_1', 'gw_post_excerpt_content_template_1', 10, 3 );
function gw_post_excerpt_content_template_1( $post_data, $form, $entry ) {

	// modify this to include whatever merge tags and words you'd like included in the excerpt
	$excerpt_template = '<div class="row-one">><a href="{Company website:14}"><span class="company-name">{Company name:12}</span></a><a href="https://twitter.com/{Company twitter:15}"><span class="company-twitter">{Company twitter:15}</span></a></div><div class="row-two"><span class="job-location">{Job location:3}</span><span class="job-type">{Job type:5}</span></div>';

	$post_data['post_excerpt'] = GFCommon::replace_variables( $excerpt_template, $form, $entry );

	return $post_data;
}
