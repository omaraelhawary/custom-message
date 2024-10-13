<?php
/*
Plugin Name: Custom Message Plugin
Description: A simple plugin to display a custom message for logged-in users.
Version: 1.0
Author: Omar ElHawary
Author URI: https://github.com/omaraelhawary
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CustomMessage{
    function __construct(){
        add_action( 'the_content', array( $this, 'custom_message' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    function custom_message($content){
        $user = wp_get_current_user();
        $userName = $user->display_name;
        $saved_message = get_option('custom_message', '');
        if( is_user_logged_in() && ! empty( $userName ) && ! empty( $saved_message ) ){
            return '<h1>' . esc_html( $saved_message ) . ' ' . esc_html( $userName ) . '</h1>' . $content;
        }
        return $content;
    }

    function admin_menu(){
        add_menu_page('Custom Message', 'Custom Message', 'manage_options', 'custom-message', array( $this, 'admin_page' ) );
    }

    function admin_page(){
        $saved_message = get_option('custom_message', '');

        if( isset( $_POST['submit_custom_message'] ) ){
            if( check_admin_referer('save_custom_message')){
                $new_message = sanitize_text_field( $_POST['custom_message'] );
                update_option( 'custom_message', $new_message );
                $saved_message = $new_message;
                echo '<div class="updated"><p>Custom message saved.</p></div>';
            }
        }
        ?>

        <div class="wrap">
            <h1>Custom Message Settings</h1>
            <form method="post" action="">
                <?php wp_nonce_field('save_custom_message'); ?>
                <table class="form-table">
                    <tr valing="top">
                        <th scrope="row"><label for="custom_message">Custom Message</label></th>
                        <td><input type="text" name="custom_message" id="custom_message" value="<?php echo esc_attr( $saved_message ); ?>" class="regular-text" required placeholder="Enter your custom message" /></td>
                </table>
                <?php submit_button('Save Custom Message', 'primary', 'submit_custom_message', false ) ?>
            </form>
        </div>

        <?php
    }

}

new CustomMessage();