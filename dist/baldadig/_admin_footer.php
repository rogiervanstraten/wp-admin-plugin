<?php
/**
 * Author: Baldadig
 * URL: http://baldadig.nl/
 * Description: 
 * Version: 1.0.1
 */

// Remove admin footer

function remove_footer_admin () {
    echo 'Handgemaakt door <a href="http://baldadig.nl">Baldadig</a>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

// Remove version number
function remove_footer_version() {
    if ( ! current_user_can('manage_options') ) { // 'update_core' may be more appropriate
        remove_filter( 'update_footer', 'core_update_footer' );
    }
}

add_action( 'admin_menu', 'remove_footer_version' );
