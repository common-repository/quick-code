<?php
/*
Plugin Name: Quick Code
Plugin URI: http://gwycon.com/quick-code/
Description: Allows admin users to test code such as HTML, CSS, PHP, and MySQL, in the admin area. Output is displayed directly above the entered code.
Version: 1.0
Author: David Gwyer
Author URI: http://gwycon.com/
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
*/

/*  Copyright 2009 David Gwyer (email : d.v.gwyer(at)gwycon.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*

*/

/* --------------------------------- */
/* Admin Interface - START */ 
/* --------------------------------- */

/* ------ Function Definitions: START ------ */
function qc_admin() {
  include('QC_adminUI.php');
}

function gc_qc_admin_actions() {
 $qc_plugin_page = add_management_page('Quick Code', 'Quick Code', 10, 'gc_qc_admin_actions_file_string', 'qc_admin');
 add_action( "admin_print_scripts-$qc_plugin_page", 'qc_load_scripts' );
}

function qc_load_scripts(){
    $file_dir = WP_PLUGIN_DIR.'/quick-code/includes';
    $file_url = WP_PLUGIN_URL.'/quick-code/includes';
    $file_url1 = WP_PLUGIN_URL.'/quick-code';

	wp_enqueue_script('gc_js_inc', $file_url . '/qc_javascript.js');
	wp_enqueue_script('gc_js_code', $file_url1 . '/code.js');
	echo "<link rel='stylesheet' href='$file_url/qc_style.css' type='text/css' />\n";
}

function gc_qc_install(){
  $file = WP_PLUGIN_DIR.'/quick-code/includes/';
  $default_output = file_get_contents($file.'output.php');
  $default_css = file_get_contents($file.'qc_style.css');
  $default_javascript = file_get_contents($file.'qc_javascript.js');
  $default_php = file_get_contents($file.'qc_php_functions.php');

  if(!get_option('qc_default')){
   add_option('qc_default', $default_output);
  }

  if(get_option('qc_dropdown' == '') || !get_option('qc_dropdown')){
    add_option('qc_dropdown', 'css_inc');
  }

  if(get_option('qc_css_content' == '') || !get_option('qc_css_content')){
    add_option('qc_css_content', $default_css);
  }
  if(get_option('qc_javascript_content' == '') || !get_option('qc_javascript_content')){
    add_option('qc_javascript_content', $default_javascript);
  }
  if(get_option('qc_php_content' == '') || !get_option('qc_php_content')){
    add_option('qc_php_content', $default_php);
  }
  // add option for custom echo from external plugin
}

/* ------ Function Definitions: END ------ */

add_action('admin_menu', 'gc_qc_admin_actions');
add_action('plugins_loaded', 'gc_qc_install' );
  
/* --------------------------------- */
/* Admin Interface - END */ 
/* --------------------------------- */


/* --------------------------------- */
/* Plugin Code - START */
/* --------------------------------- */

/* ------ Function Definitions: START ------ */

/* ------ Function Definitions: END ------ */

/* --------------------------------- */
/* Plugin Code - END */
/* --------------------------------- */


/* --------------------------------- */
/* Internationalization Code - START */
/* --------------------------------- */

function qc_init() {
  load_plugin_textdomain('qc_domain', 'wp-content/plugins/quick-code/i18n');
}

add_action('init', 'qc_init');

/* --------------------------------- */
/* Internationalization Code - END */
/* --------------------------------- */

?>