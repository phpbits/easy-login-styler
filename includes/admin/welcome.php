<?php
/**
 * Create dashboard welcome page after activation
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * EasyLoginStyler_Dashboard_Welcome Class
 */

class EasyLoginStyler_Dashboard_Welcome {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'screen_page' ) );
		add_action( 'activated_plugin', array( $this, 'redirect' ) );
		add_action( 'admin_head', array( $this, 'remove_menu' ) );
	}

	/**
	 * Setup the admin menu.
	 */
	public function screen_page() {
		add_dashboard_page(
			__( 'Easy Login Styler', 'easy-login-styler' ),
			__( 'Easy Login Styler', 'easy-login-styler' ),
			apply_filters( 'easyloginstyler_welcome_screen_capability', 'manage_options' ),
			'easy-login-styler--welcome',
			array( $this, 'content' )
		);
	}

	/**
	 * Remove the menu item from the admin.
	 */
	public function remove_menu() {
		remove_submenu_page( 'index.php', 'easy-login-styler--welcome' );
	}

	/**
	 * Page header.
	 */
	public function header() {

		$selected = isset( $_GET['page'] ) ? $_GET['page'] : 'easy-login-styler--welcome';
		?>
		<h1><?php echo esc_html__( 'Welcome to Easy Login Styler', 'easy-login-styler' ); ?></h1>

		<?php
	}

	/**
	 * Page content.
	 */
	public function content() {
	?>
		<div class="wrap about-wrap easy-login-styler--about-wrap">
			<?php $this->header(); ?>
			<div class="about-description">
				<p><?php echo esc_html__( 'We recommend you watch this instructions below to get started, then you will be up and running in no time.', 'easy-login-styler' ); ?></p>
				<div class="featured-video">
					<iframe src="https://player.vimeo.com/video/206392470" width="530" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
				<p>
					<a href="<?php echo esc_url( admin_url( 'options-general.php?page=easy_login_styler_plugin_settings' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Style Your Login Page Now', 'easy-login-styler' ); ?></a>
					<a href="https://easyloginwp.com/setup-free-wordpress-login-page/?utm_source=free-welcome-page" class="button button-secondary" target="_blank"><?php echo esc_html__( 'View Full Tutorials', 'easy-login-styler' ); ?></a>
				</p>
				<p><?php echo esc_html__( 'OR', 'easy-login-styler' ); ?></p>
				<h3><?php echo esc_html__( 'Checkout the Pro Version Preview', 'easy-login-styler' ); ?></h3>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/CEvDwuNq5t4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<p>
					<a href="https://easyloginwp.com/?utm_source=welcome-upgrade" target="_blank" class="button button-primary"><?php echo esc_html__( 'Check Pro Version Features', 'easy-login-styler' ); ?></a>
				</p>
			</div>
		</div>
		<style type="text/css" media="screen">
			.easy-login-styler--about-wrap h1{
		    	color: #000;
		    	text-align: center;
		    	font-size: 31px;
		    	margin: 50px 0px 30px;
		    }
		    .easy-login-styler--about-wrap .about-description{
		    	font-size: 16px;
		    	color: #000;
		    	background: #fff;
			    border: 1px solid #e1e1e1;
			    padding: 40px;
			    box-shadow: 1px 5px 15px rgba(0,0,0,0.02);
			    border-radius: 2px;
			    text-align: center;
		    }
		    .easy-login-styler--about-wrap .about-description .featured-video{
		    	margin-top: 30px;
		    }
		    .easy-login-styler--about-wrap .about-description .button{
		    	font-size: 16px;
		    	height: auto;
		    	width: auto;
		    	padding: 15px 30px;
		    	margin: 10px;
		    }
		    .easy-login-styler--about-wrap iframe{
		    	max-width: 100%;
		    }
		</style>
	<?php
	}

	/**
	 * Redirect to the welcome page upon plugin activation.
	 */
	public function redirect( $plugin ) {
		if ( ( $plugin == 'easy-login-styler/plugin.php' ) && ! isset( $_GET['activate-multi'] ) ) {
			wp_safe_redirect( admin_url( 'index.php?page=easy-login-styler--welcome' ) );
			die();
		}
	}
}

return new EasyLoginStyler_Dashboard_Welcome();