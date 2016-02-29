<?php
/*
Plugin Name: Auto Google Chrome Frame
Plugin URI: http://semperfiwebdesign.com/wordpress-plugins/auto-google-chrome-frame/
Description: Adds Google Chrome frame to website automatically.
Author: Michael Torbert
Version: .1
Author URI: http://semperfiwebdesign.com/
*/

/*
Copyright (C) 2008-2009 Michael Torbert, semperfiwebdesign.com (michael AT semperfiwebdesign DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );



add_action('admin_menu', 'agcf_add_page');

function agcf_add_page() {
    add_options_page('Google Chrome Frame', 'Google Chrome Frame', 'administrator', 'autogooglechromefram', 'agcf_options_page');

  
}


function agcf_options_page() {
	?>
	<div class="wrap">
	<h2>Auto Google Chrome Frame</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	
Add Google Chrome Frame code automatically to website.	

	<input type="checkbox" name="auto-google-chrome-frame-on" <?php if(get_option('auto-google-chrome-frame-on')) echo 'checked="1"'; ?> />	



Check whether user has Chrome Frame, and prompt them to install it if not.	
	<input type="checkbox" name="auto-google-chrome-check" <?php if(get_option('auto-google-chrome-check')) echo 'checked="1"'; ?> />	

<?php if(get_option('auto-google-chrome-check')) echo '<br /><em>It is recommended that you move your wp_head() function call in your header.php file to the top of the <head> section.'; ?>

	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="auto-google-chrome-frame-on,auto-google-chrome-check" />

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
	</div>

<?php
 
}

if(get_option('auto-google-chrome-frame-on')){
	add_action('wp_head','agcf_add_to_head');
}

if(get_option('auto-google-chrome-check')){
	add_action('wp_head','agcf_add_check_to_head');
}

function agcf_add_to_head(){
	echo '<meta http-equiv="X-UA-Compatible" content="chrome=1">';
}

function agcf_add_check_to_head(){
	echo '<!--[if IE]><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script><![endif]-->';
}

?>