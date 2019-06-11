<?php namespace WSUWP\Code_Library;

/**
 * Use this class to define options set via post meta.
 *
 * @version: 0.0.1
 * @package https://github.com/washingtonstateuniversity/wsuwp-code-library/blob/master/post/class-post-options.php
 */

class Site_Options {


    /**
	 * Default options. When options are being set the following will be added as defaults.
	 * @since 0.0.1
	 *
	 * @var array $options_defaults Default option values
	 */
	protected $settings_defaults = array(
		'sanitize_type'     => 'text_array', // Type of content to sanitize (optional)
		'sanitize_callback' => false,  // Custom callback to use to sanitize the value (optional).
		'save_default'      => false,  // Save default value if input field is empty (optional).
		'default_value'     => '',     // Default value to save if save_default is true (optional).
		'value'             => '',     // Set value of the option (optional).
		'placeholder'       => '',     // Placeholder for the option (optional).
    );


    /**
	 * Property to store set options. Is populated by calling
	 * set_post_options_by_post_id or similar.
	 * @since 0.0.1
	 *
	 * @var array $post_options_array Array of post options and args. Will be in
	 * the form of meta_key => array $options (see $options_defaults above).
	 */
    protected $site_options_array = array();
    

    public function __construct() {

		// If options array exist set the defaults.
		if ( ! empty( $this->post_options_array ) ) {

			$this->set_options_defaults();

		} // End if
	}
    

}
