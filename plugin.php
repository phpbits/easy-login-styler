<?php
/**
 * Plugin Name: Easy Login Styler
 * Plugin URI: https://wordpress.org/plugins/easy-login-styler/
 * Description: Simple Login Page Customization.
 * Version: 1.0.6
 * Author: Phpbits Creative Studio
 * Author URI: https://phpbits.net/
 * Text Domain: easy-login-styler
 * Domain Path: languages
 *
 * @category Login
 * @author Jeffrey Carandang
 * @version 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Easy_Login_Styler' ) ) :

/**
 * Main Easy_Login_Styler Class.
 *
 * @since  1.0
 */
final class Easy_Login_Styler {
	/**
	 * @var Easy_Login_Styler The one true Easy_Login_Styler
	 * @since  1.0
	 */
	private static $instance;

	/**
	 * Main Easy_Login_Styler Instance.
	 *
	 * Insures that only one instance of Easy_Login_Styler exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since  1.0
	 * @static
	 * @staticvar array $instance
	 * @uses Easy_Login_Styler::setup_constants() Setup the constants needed.
	 * @uses Easy_Login_Styler::includes() Include the required files.
	 * @uses Easy_Login_Styler::load_textdomain() load the language files.
	 * @see Easy_Login_Styler()
	 * @return object|Easy_Login_Styler The one true Easy_Login_Styler
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Easy_Login_Styler ) ) {
			self::$instance = new Easy_Login_Styler;
			self::$instance->setup_constants();

			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
			// self::$instance->roles         = new WIDGETOPTS_Roles();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 4.1
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'EASY_LOGIN_STYLER_PLUGIN_NAME' ) ) {
			define( 'EASY_LOGIN_STYLER_PLUGIN_NAME', 'Easy Login Styler' );
		}

		// Plugin version.
		if ( ! defined( 'EASY_LOGIN_STYLER_VERSION' ) ) {
			define( 'EASY_LOGIN_STYLER_VERSION', '1.0.6' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'EASY_LOGIN_STYLER_PLUGIN_DIR' ) ) {
			define( 'EASY_LOGIN_STYLER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'EASY_LOGIN_STYLER_PLUGIN_URL' ) ) {
			define( 'EASY_LOGIN_STYLER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'EASY_LOGIN_STYLER_PLUGIN_FILE' ) ) {
			define( 'EASY_LOGIN_STYLER_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function includes() {
		require_once EASY_LOGIN_STYLER_PLUGIN_DIR . 'includes/login-functions.php';
		if( is_admin() ){
			require_once EASY_LOGIN_STYLER_PLUGIN_DIR . 'includes/install.php';
			require_once EASY_LOGIN_STYLER_PLUGIN_DIR . 'includes/admin/settings.php';
			require_once EASY_LOGIN_STYLER_PLUGIN_DIR . 'includes/admin/notices.php';
			require_once EASY_LOGIN_STYLER_PLUGIN_DIR . 'includes/admin/welcome.php';
		}
	}

}

endif; // End if class_exists check.


/**
 * The main function for that returns Easy_Login_Styler
 *
 * The main function responsible for returning the one true Easy_Login_Styler
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $widgetopts = Easy_Login_Styler(); ?>
 *
 * @since 1.0
 * @return object|Easy_Login_Styler The one true Easy_Login_Styler Instance.
 */
if( !function_exists( 'Easy_Login_Styler_FN' ) ){
	function Easy_Login_Styler_FN() {
		return Easy_Login_Styler::instance();
	}
	// Get Plugin Running.
	Easy_Login_Styler_FN();
}
?>
