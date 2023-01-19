<?php
/*
Plugin Name: Nafenzi System Plugin
Plugin URI: https://www.fajarpos.co.id/
Description: Nafenzi System Plugin dikembangkan oleh PT. Nafenzi Fajarpos Media.
Version: 1.0.0
Author: PT. Nafenzi Fajarpos Media
Author URI: https://www.fajarpos.co.id/
*/

//Hide All Generator Wordpress //
function remove_meta_generators($html) {
    $pattern = '/<meta name(.*)=(.*)"generator"(.*)>/i';
    $html = preg_replace($pattern, '', $html);
    return $html;
}
function clean_meta_generators($html) {
    ob_start('remove_meta_generators');
}
add_action('get_header', 'clean_meta_generators', 100);
add_action('wp_footer', function(){ ob_end_flush(); }, 100);

/**
 * Change Title Admin Wordpress
**/

add_action('login_title', 'rewrite_login_title');
function rewrite_login_title() {
      $title = __( 'Masuk' );
      $login_title = get_bloginfo( 'name', 'display' );
      $login_title = sprintf( __( '%1$s | %2$s' ), $title, $login_title );
      return $login_title;
}

add_action('admin_title', 'rewrite_admin_title');
function rewrite_admin_title() {
	global $title;
	$title = strip_tags( $title );
	if ( is_network_admin() ) {
		/* translators: Network admin screen title. %s: Network title. */
		$admin_title = sprintf( __( 'Fajarpos Network: %s' ), get_network()->site_name );
	} elseif ( is_user_admin() ) {
		/* translators: User dashboard screen title. %s: Network title. */
		$admin_title = sprintf( __( 'Fajarpos Media: %s ' ), get_network()->site_name );
	} else {
		$admin_title = get_bloginfo( 'name' );
	}
	
	if ( $admin_title === $title ) {
		/* translators: Admin screen title. %s: Admin screen name. */
		$admin_title = sprintf( __( '%s' ), $title );
	} else {
		/* translators: Admin screen title. 1: Admin screen name, 2: Network or site name. */
		$admin_title = sprintf( __( '%1$s | %2$s' ), $title, $admin_title );
	}
	return $admin_title;
}
?>