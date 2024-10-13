<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CustomMessageFrontend {
    /**
     * This function is the hook for the CustomMessageFrontend class.
     * It adds the custom_message function to the the_content filter.
     *
     * @since 1.0
     */
    public static function init() {
        add_action( 'the_content', array( __CLASS__, 'custom_message' ) );
    }

    /**
     * This function is hooked into the_content filter and checks if the user is logged in,
     * and if the display name and saved message are not empty. If all conditions are met,
     * it prepends the saved message to the content
     *
     * @param string $content The content of the page
     * @return string The content with the custom message prepended if conditions are met
     */
    public static function custom_message($content) {
        $user = wp_get_current_user();
        $userName = $user->display_name;
        $saved_message = get_option('custom_message', '');
        if( is_user_logged_in() && ! empty( $userName ) && ! empty( $saved_message ) ){
            return '<h1>' . esc_html( $saved_message ) . ' ' . esc_html( $userName ) . '</h1>' . $content;
        }
        return $content;
    }
}