<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CustomMessageAdmin {
    /**
     * Initializes the plugin by adding the action to render the admin menu.
     * 
     * @return void
     */
    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
    }

    /**
     * Renders the admin menu by adding a new menu item
     * 
     * @return void
     */
    public static function admin_menu() {
        add_menu_page('Custom Message', 'Custom Message', 'manage_options', 'custom-message', array( __CLASS__, 'admin_page' ) );
    }

    /**
     * Renders the admin page by displaying a form to save the custom message.
     * 
     * This function is called when the admin menu item is clicked.
     * 
     * @return void
     */
    public static function admin_page() {
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