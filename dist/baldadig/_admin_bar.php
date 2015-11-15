<?php
/**
 * Author: Baldadig
 * URL: http://baldadig.nl/
 * Description: 
 * Version: 1.0.1
 */

function add_masthead() {?>
	<style type="text/css">
		#wpadminbar .masthead-baldadig {
			background: transparent url('<?php echo plugins_url('images/masthead-white-admin-bar-animated.gif', __FILE__); ?>') no-repeat;
			background-size: contain;
			top: 1px ;
			margin-left: 4px;
			width: 32px;
		}

		#wpadminbar ul li#wp-admin-bar-baldadig:hover>.ab-item {
			background: none;
		}

		#wpadminbar ul li#wp-admin-bar-baldadig > .ab-item {
			pointer-events: none;
			cursor: default;
			text-indent: -9999px;
			height: 32px;
		}

	</style>
<?php
}

add_action('wp_before_admin_bar_render', 'add_masthead', 0);

function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

function add_masthead_node( $wp_admin_bar ) {
	$args = array(
		'id'    => 'baldadig',
		'title' => 'Baldadig',
		'href'  => get_admin_url(),
		'meta'  => array(
			'class' => 'masthead-baldadig'
		)
	);
	$wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'add_masthead_node', 0 );
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
