<?php
/**
 * Admin Options Page
 * Settings > Easy Login Styler
 *
 * @copyright   Copyright (c) 2017, Jeffrey Carandang
 * @since       1.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Creates the admin submenu pages under the Settings menu and assigns their
 *
 * @since 1.0
 * @return void
 */
if( !function_exists( 'easy_login_styler_options_link' ) ):
	function easy_login_styler_options_link() {
		add_options_page(
			__( 'Easy Login Styler', 'easy-login-styler' ),
			__( 'Easy Login Styler', 'easy-login-styler' ),
			'manage_options',
			'easy_login_styler_plugin_settings',
			'easy_login_styler_options_page'
		);
	}
	add_action( 'admin_menu', 'easy_login_styler_options_link', 30 );
	add_action('admin_init', 'easy_login_styler_options_cb');
endif;

if( !function_exists( 'easy_login_styler_options_cb' ) ):
	function easy_login_styler_options_cb(){
	    register_setting( 'easy_login_styler_settings_group', 'easy_login_styler_settings', 'easy_login_styler_settings_sanitize');
	}
endif;

if( !function_exists( 'easy_login_styler_options_scripts' ) ):
	function easy_login_styler_options_scripts( $hook ) {
		if( 'settings_page_easy_login_styler_plugin_settings' == $hook ){
			wp_enqueue_media();
		}
	}
	add_action( 'admin_enqueue_scripts', 'easy_login_styler_options_scripts' );
endif;

/**
 * Options Page
 *
 * Renders the options page contents.
 *
 * @since 1.0
 * @return void
 */
if( !function_exists( 'easy_login_styler_options_page' ) ):
	function easy_login_styler_options_page(){
		 $options = get_option( 'easy_login_styler_settings' ); ?>
	     <div class="wrap">
			<h1>
				<?php _e( 'Easy Login Styler', 'easy-login-styler' ); ?>
				<a href="<?php echo esc_url( apply_filters( 'easy_login_styler_support_url', 'https://wordpress.org/support/plugin/easy-login-styler' ) ); ?>" target="_blank" class="page-title-action"><?php _e( 'Support', 'easy-login-styler' ); ?></a>
			</h1>

			<div id="easy-login-styler-settings-messages-container"></div>
			<div class="easy-login-styler-settings-desc">
				<p><?php _e( 'Customize the login screen using the option provided below. You can also add you own CSS styling using the provided field for custom CSS code that will only appear on the login page.', 'easy-login-styler' );?></p>
			</div>

			<div id="poststuff" class="easy-login-styler-poststuff">
				<div id="post-body" class="metabox-holder columns-2 hide-if-no-js">
					<div id="postbox-container-2" class="postbox-container">

						<div class="easy-login-styler-container hide-if-no-js">
							<form method="post" action="options.php" id="easy-login-styler-settings-form">
								<?php settings_fields( 'easy_login_styler_settings_group' ); ?>
    							<?php do_settings_sections( 'easy_login_styler_plugin_settings' ); ?>

								<table class="form-table easy-login-styler-settings-table">
									<tr>
										<th scope="row">
											<label><?php _e( 'Logo Image', 'easy-login-styler' );?></label>
										</th>
										<td>
											<button class="button button-primary easy_login_styler_uploaded" data-field=".easy_login_styler_logo_fld" data-preview=".easy_login_styler_logo_preview" data-title="<?php _e( 'Select or Upload Logo', 'easy-login-styler' );?>" data-text="<?php _e( 'Use as Logo', 'easy-login-styler' );?>"><?php _e( 'Select or Upload Image', 'easy-login-styler' );?></button>
											<?php if( is_array( $options ) && isset( $options['logo'] ) && !empty( $options['logo'] ) ): ?>
												&nbsp;&nbsp;<a href="#" class="easy_login_styler_remove" data-field=".easy_login_styler_logo_fld" data-preview=".easy_login_styler_logo_preview"  ><?php _e( 'Remove Logo Image', 'easy-login-styler' );?></a>
											<?php endif; ?>
											<input type="hidden" class="easy_login_styler_logo_fld" name="easy_login_styler_settings[logo]" value="<?php echo ( is_array( $options ) && isset( $options['logo'] ) ) ? $options['logo'] : '';?>" />
											<div class="easy_login_styler_logo_preview"><?php echo ( is_array( $options ) && isset( $options['logo'] ) && !empty( $options['logo'] ) ) ? '<img src="'. $options['logo'] .'">' : '';?></div>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label><?php _e( 'Background Image', 'easy-login-styler' );?></label>
										</th>
										<td>
											<button class="button button-primary easy_login_styler_uploaded" data-field='.easy_login_styler_image_fld' data-preview=".easy_login_styler_image_preview" data-title="<?php _e( 'Select or Upload Background Image', 'easy-login-styler' );?>" data-text="<?php _e( 'Use as Background', 'easy-login-styler' );?>"><?php _e( 'Select or Upload Image', 'easy-login-styler' );?></button>
											<?php if( is_array( $options ) && isset( $options['background'] ) && !empty( $options['background'] ) ): ?>
												&nbsp;&nbsp;<a href="#" class="easy_login_styler_remove" data-field='.easy_login_styler_image_fld' data-preview=".easy_login_styler_image_preview" ><?php _e( 'Remove Background Image', 'easy-login-styler' );?></a>
											<?php endif; ?>
											<input type="hidden" class="easy_login_styler_image_fld" name="easy_login_styler_settings[background]" value="<?php echo ( is_array( $options ) && isset( $options['background'] ) ) ? $options['background'] : '';?>" />
											<div class="easy_login_styler_image_preview"><?php echo ( is_array( $options ) && isset( $options['background'] ) && !empty( $options['background'] ) ) ? '<img src="'. $options['background'] .'">' : '';?></div>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label><?php _e( 'Custom Login CSS', 'easy-login-styler' );?></label>
										</th>
										<td>
											<textarea class="widefat" name="easy_login_styler_settings[css]" rows="10"><?php echo ( is_array( $options ) && isset( $options['css'] ) ) ? esc_textarea( $options['css'] ) : '';?></textarea>
											<small><?php _e( 'Add Custom CSS code that will appear only on the login screen.', 'easy-login-styler' );?></small>
										</td>
									</tr>
								</table>

								<?php
								if( function_exists('submit_button')) { submit_button(); } else { ?>
									<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'easy-login-styler' );?>"></p>
								<?php } ?>
							</form>

							</form>
						</div>
						<div class="easy-login-styler-modal-background"></div>
					</div>

					<div id="postbox-container-1" class="postbox-container">
						<a href="http://widget-options.com/?utm_source=easy-login-admin&amp;utm_medium=sidebar&amp;utm_campaign=easy-login-admin-banner" target="_blank"><img src="<?php echo EASY_LOGIN_STYLER_PLUGIN_URL;?>/assets/images/banner-widget-options-wordpress.jpg" /></a><br /><br />
						<a href="http://phpbits.net/plugin/mobi/?utm_source=easy-login-admin&amp;utm_medium=sidebar&amp;utm_campaign=easy-login-admin-banner" target="_blank"><img src="<?php echo EASY_LOGIN_STYLER_PLUGIN_URL;?>/assets/images/banner-mobi.jpg" /></a><br /><br />
						<a href="https://wordpress.org/plugins/forty-four/" target="_blank"><img src="<?php echo EASY_LOGIN_STYLER_PLUGIN_URL;?>/assets/images/banner-404.jpg" /></a>
					</div>

				</div>
			</div>
		</div>

		<style type="text/css">
			.easy-login-styler-settings-table{
				width: 100%;
			}
			.easy-login-styler-settings-table img{
				max-width: 100%;
			}
			.easy_login_styler_image_preview{
				display: block;
				width: 100%;
			}
			.easy_login_styler_image_preview img{
				padding: 15px 0px;
			}
			.easy_login_styler_remove{
				line-height: 25px;
				color: #a00;
			}
			.easy_login_styler_logo_preview img{
				width: 84px;
				padding: 15px 0px;
			}
			.easy-login-styler-poststuff .postbox-container img{
				max-width: 100%;
				border: 0px;
			}
		</style>

		<script type="text/javascript">
			jQuery( document ).ready( function(){
				var file__frame;

			    jQuery( 'body' ).on( 'click', '.easy_login_styler_uploaded', function( event ){
			        event.preventDefault();

					var fld = jQuery( this ).attr( 'data-field' );
					var preview = jQuery( this ).attr( 'data-preview' );

			        // Create the media frame.
			        file__frame = wp.media.frames.file__frame = wp.media({
			          title: jQuery( this ).attr( 'data-title' ),
			          button: {
			            text: jQuery( this ).attr( 'data-text' ),
			          },
			          multiple: false  // Set to true to allow multiple files to be selected
			        });

			        // When an image is selected, run a callback.
			        file__frame.on( 'select', function() {
			          // We set multiple to false so only get one image from the uploader
			          attachment = file__frame.state().get('selection').first().toJSON();
			          jQuery( fld ).val( attachment.url );
			          jQuery( preview ).html('<img src="'+ attachment.url +'" />');
			          // jQuery('#wpautbox_user_image_url').html('<img src="'+ attachment.url +'" width="120"/><br />');
			          // Do something with attachment.id and/or attachment.url here
			        });

			        // Finally, open the modal
			        file__frame.open();
			    });

				jQuery( '.easy_login_styler_remove' ).on( 'click' ,function(e){

					var fld = jQuery( this ).attr( 'data-field' );
					var preview = jQuery( this ).attr( 'data-preview' );

			    	jQuery( fld ).val('');
			       	jQuery( preview ).html('');
					e.preventDefault();
					e.stopPropagation();
			    });
			} );
		</script>

	     <?php
	 }
 endif;
?>
