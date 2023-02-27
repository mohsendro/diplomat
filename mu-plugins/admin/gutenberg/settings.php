<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'GutenbergSettings' ) ) {

	class GutenbergSettings {

		public function __construct() {

            add_action( 'admin_init', array( $this, 'wpplus_register_field_type_editor' ) );

		}

        public function wpplus_register_field_type_editor() {

            register_setting( 'writing', 'type_editor' );

            add_settings_field( 
                'type_editor',
                'ویرایشگر پیشفرض', 
                array( $this, 'wpplus_setting_callback_function' ), //Function to Call
                'writing', 
                'default',
                array( 
                    'value' => get_option('type_editor')
                )
            );

        }

        public function wpplus_setting_callback_function( $args ) {

            $value = $args['value'];

            echo '
            <div class="radio-group">
                <input name="type_editor" id="type_editor_classic" value="classic" type="radio" '. checked($value, "classic", false) .'>
                <label for="type_editor_classic">کلاسیک</label>
                <input name="type_editor" id="type_editor_gutenberg" value="gutenberg" type="radio" '. checked($value, "gutenberg", false) .'>
                <label for="type_editor_gutenberg">گوتنبرگ</label>
            </div>
            ';

        }

	}

}
// $gutenberg_settins = new GutenbergSettings;       