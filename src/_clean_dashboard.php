<?php
/**
 * Author: %%AUTHOR%%
 * URL: %%AUTHORURI%%
 * Description: %%DESCRIPTION%%
 * Version: %%VERSION%%
 */

if ( ! function_exists('remove_dashboard_meta') ) :
  function remove_dashboard_meta() {
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_welcome', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  }
endif;

add_action( 'admin_init', 'remove_dashboard_meta' );
