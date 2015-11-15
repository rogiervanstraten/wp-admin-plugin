<?php
/**
 * Author: Baldadig
 * URL: http://baldadig.nl/
 * Description: 
 * Version: 1.0.1
 */

if ( ! function_exists('add_masthead_to_login') ) :
	function add_masthead_to_login() { ?>

		<style>
			body.login #login h1 a {
				display: block;
				background: url("<?php echo plugins_url('images/masthead@2x.png', __FILE__); ?>") no-repeat transparent;
				background-size: 100px 100px ;
				width: 100px;
				height: 100px;
				margin-bottom: 50px ;
			}
		</style>

	<?php
	}
endif;

add_action("login_head", "add_masthead_to_login");
