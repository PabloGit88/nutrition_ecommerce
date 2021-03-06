<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * Contact Area Component
 *
 * Here we setup all logic and XHTML that is required for the contact area component, used on the homepage.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;

	$settings = array(
				'homepage_contact_area_heading' => '',
				'homepage_contact_area_title' => '',
                'homepage_enable_social' => 'true',
                'homepage_enable_contactform' => 'true'
				);

	$settings = woo_get_dynamic_values( $settings );

?>

<div id="contact-area" class="widget_woo_component">

    <div class="col-full">

    	<h2 class="widget-title"><?php echo esc_html( $settings['homepage_contact_area_heading'] ); ?></h2>

		<span class="heading"><?php echo esc_html( $settings['homepage_contact_area_title'] ); ?></span>
    	<?php
            if ( 'true' == $settings['homepage_enable_social'] ) {
               woo_display_social_icons();
            }

            if ( 'true' == $settings['homepage_enable_contactform'] ) {
            if ( isset( $_GET['message'] ) && 'success' == $_GET['message'] ) {
                echo do_shortcode( '[box type="tick"]' . __( 'Your message has been sent successfully.', 'woothemes' ) . '[/box]' );
            }
            if ( isset( $_GET['message'] ) && 'fields-missing' == $_GET['message'] ) {
                echo do_shortcode( '[box type="alert"]' . __( 'There are fields missing or incorrect. Please try again.', 'woothemes' ) . '[/box]' );
            }
            if ( isset( $_GET['message'] ) && 'invalid-verify' == $_GET['message'] ) {
                echo do_shortcode( '[box type="alert"]' . __( 'The verification code entered is incorrect. Please try again.', 'woothemes' ) . '[/box]' );
            }
            if ( isset( $_GET['message'] ) && 'error' == $_GET['message'] ) {
                echo do_shortcode( '[box type="alert"]' . __( 'There was an error sending your message. Please try again.', 'woothemes' ) . '[/box]' );
            }

            // If the form has errors, get the form data back.
            $data = woo_get_posted_contact_form_data();
        ?>
    	<form id="homepage-contact-form" action="" method="post">
    		<textarea name="contact-message" placeholder="<?php esc_attr_e( 'Your Message', 'woothemes' ); ?>" value="<?php echo esc_textarea( $data['contact-message'] ); ?>"></textarea>
    		<div class="col-right">
    			<input type="text" name="contact-name" placeholder="<?php esc_attr_e( 'Name and Surname', 'woothemes' ); ?>" value="<?php echo esc_attr( $data['contact-name'] ); ?>" />
    			<input type="text" name="contact-email" placeholder="<?php esc_attr_e( 'Your email address', 'woothemes' ); ?>" value="<?php echo esc_attr( $data['contact-email'] ); ?>" />
                <input type="text" name="contact-verify" placeholder="<?php esc_attr_e( '7 + 12 = ?', 'woothemes' ); ?>" />
                <input type="hidden" name="contact-form-submit" value="yes" />
    			<input type="submit" value="<?php esc_attr_e( 'Send that email!', 'woothemes' ); ?>" />
    		</div>
    	</form>
    	<?php } ?>
    </div>

</div>