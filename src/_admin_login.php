<?php
/**
 * Author: %%AUTHOR%%
 * URL: %%AUTHORURI%%
 * Description: %%DESCRIPTION%%
 * Version: %%VERSION%%
 */

function add_masthead_to_login() {?>

	<style>
		body.login #login h1 a {
			display: block;
			background: url("<?php echo get_bloginfo('template_url'); ?>/baldadig/images/masthead@2x.png") no-repeat transparent;
			background-size: 100px 100px ;
			width: 100px;
			height: 100px;
			margin-bottom: 50px ;
		}
	</style>

<?php
}

add_action("login_head", "add_masthead_to_login");
