<?php
/**
 * Plugin Name: I Love Coding
 * Plugin Default Slug: i-love-coding
 * Plugin URI: wpressthim.com
 * Description: Add a custom Column to Media Library page.
 * Version: 1.0
 * Author: Duc Linh
 * Author URI: facebook.com/
 * License: GPLv2
 */
 

define( 'ILC_NAME', 'i-love-coding' );
define( 'ILC_DIR', plugin_dir_path(__FILE__) );
define( 'ILC_URL', plugin_dir_url(__FILE__) );
define( 'ILC_CSS', ILC_URL . "css/" );
define( 'ILC_JS', ILC_URL . "js/" );
define( 'ILC_TEMPLATES', ILC_DIR . "templates/" );

 if(!class_exists('I_Love_Coding')) {
	class I_Love_Coding {
		function __construct() {
			/* init hook */
			add_action( 'init', array( $this, 'ilc_init_hook' ) );
		}

		function ilc_init_hook() {
			add_action( 'admin_init', array( $this, 'ilc_enqueue_script' ) );
			require_once ILC_TEMPLATES . 'functions.php';
		}
		function ilc_enqueue_script(){
			// use wp_register_style to add stylesheet to admin page
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'ilc-admin-script', ILC_JS . 'ilc-admin-main.js', array( 'jquery' ), '1.0', true );
			wp_localize_script( 'ilc-admin-script', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_add_inline_script('love-code-script', ilc_custom_js());
		}
	}
}
function ilc_load() {
        global $ilc;
        $ilc = new I_Love_Coding();
}
add_action( 'plugins_loaded', 'ilc_load' );