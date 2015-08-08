<?php
/**
 * Author: %%AUTHOR%%
 * URL: %%AUTHORURI%%
 * Description: %%DESCRIPTION%%
 * Version: %%VERSION%%
 */

define(BALDADIG_RSS_FEED, 'https://roddels.baldadig.nl/');

function add_dashboard_widgets() {

	wp_add_dashboard_widget('dashboard_baldadig_rss', 'Baldadig Nieuws', 'add_dashboard_rss_widget');
	wp_add_dashboard_widget( 'dashboard_baldadig_welcome', 'Baldadig Dashboard', 'add_welcome_widget' );

}

function add_dashboard_rss_widget() {

	// set client specific feed
	$client = '?client=' . slugify( get_bloginfo('name') ) . '&language=' . get_locale();
	$rss = fetch_feed( BALDADIG_RSS_FEED . $client );

	if ( is_wp_error($rss) ) {

		if ( is_admin() || current_user_can('manage_options') ) {
			echo '<p>';
			printf(__('<strong>RSS Error</strong>: %s'), $rss->get_error_message());
			echo '</p>';
    }

		return;

	}

	if ( !$rss->get_item_quantity() ) {

		echo '<p>We hebben nog geen nieuws voor je.</p>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo "<ul>\n";

	if ( !isset($items) )

		$items = 5;
		foreach ( $rss->get_items(0, $items) as $item ) {
			$publisher = '';
			$site_link = '';
			$link = '';
			$content = '';
			$date = '';
			$link = esc_url( strip_tags( $item->get_link() ) );
			$title = esc_html( $item->get_title() );
			$content = $item->get_content();
			$content = wp_html_excerpt($content, 250) . ' ...';

			echo "<li><a class='rsswidget' href='$link'>$title</a>\n<div class='rssSummary'>$content</div>\n";
		}

		echo "</ul>\n";
		$rss->__destruct();
		unset($rss);

}

function add_welcome_widget() { ?>

	<img src="<?php echo get_bloginfo('template_url'); ?>/baldadig/images/masthead@2x.png" style="float:right;margin:10px 10px;" width="100" height="100" />
  Welkom bij het dashboard van <?php bloginfo('name'); ?>. Dit is een website gemaakt door <strong><a target="_blank" style="color:#444;" href="http://baldadig.nl">Baldadig</a></strong>.
  <br/><br/><br/>
  <strong>Handige links</strong>
  <ul>
  	<li><a target="_blank" style="color:rgb(63,106,247);" href="http://baldadig.nl">Baldadig</a></li>
  	<li><a target="_blank" style="color:rgb(63,106,247);" href="mailto: wijzijn@baldadig.nl">Problemen met Wordpress?</a></li>
  </ul>
  <br />
  <hr>
  <br />
  <strong>Wij zijn Baldadig</strong><br /><br />
  Een vers gestart creatief bureau uit Haarlem. Met de gebundelde krachten van design, development en online marketing leveren wij online totaalconcepten waar we trots op zijn.

<?php }

add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );
