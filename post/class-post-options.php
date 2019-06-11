<?php namespace WSUWP\Code_Library;

/**
 * Use this class to define options set via post meta.
 *
 * @version: 0.0.1
 * @package https://github.com/washingtonstateuniversity/wsuwp-code-library/blob/master/post/class-post-options.php
 */

class Post_Options {


	/**
	 * Default options. When options are being set the following will be added as defaults.
	 * @since 0.0.1
	 *
	 * @var array $options_defaults Default option values
	 */
	protected $options_defaults = array(
		'sanitize_type'     => 'text', // Type of content to sanitize (optional)
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
	protected $post_options_array = array();


	public function __construct() {

		// If options array exist set the defaults.
		if ( ! empty( $this->post_options_array ) ) {

			$this->set_options_defaults();

		} // End if
	}

	/**
	 * Set the default options using property $options_defaults.
	 * @since 0.0.1
	 *
	 * @param string|bool $option_key Meta key used for the option.
	 * @param array       $option_set_args Array of options args. see property $$options_defaults for
	 * available options.
	 */
	public function set_options_defaults( $option_key = false, $option_set_args = array() ) {

		if ( ! empty( $option_key ) ) {

			$post_options_array = array(
				$option_key => $option_set_args,
			);

		} else {

			$post_options_array = $this->get_post_options_array();

		}// End if

		foreach ( $post_options_array as $key => $options ) {

			$option_args = array_merge( $this->options_defaults, $options );

			$this->post_options_array[ $key ] = $option_args;

		} // End foreach

	} // End set_options_defaults


	/**
	 * Set the options value by post_id.
	 * @since 0.0.1
	 *
	 * @param int $post_id Current post ID
	 */
	public function set_post_options_values( $post_id ) {

		$post_options_array = $this->get_post_options_array();

		foreach ( $post_options_array as $key => $options ) {

			$option_args = array_merge( $this->options_defaults, $options );

			$value = get_post_meta( $post_id, $key, true );

			$option_args['value'] = $value;

			$this->post_options_array[ $key ] = $option_args;

		} // End foreach

	}


	/**
	 * Get value of $post_options_array property
	 * @since 0.0.1
	 *
	 * @return array Post options array
	 */
	public function get_post_options_array() {

		return $this->post_options_array;

	}


	/**
	 * Get options array for a specific option.
	 * @since 0.0.1
	 *
	 * @param string $key Option key to get
	 *
	 * @return array Post option array for given key.
	 */
	public function get_post_option( $key ) {

		$post_options_array = $this->get_post_options_array();

		if ( array_key_exists( $key, $post_options_array ) ) {

			return $post_options_array[ $key ];

		} else {

			return array();

		} // End if

	}

	/**
	 * Get the value for a specific option
	 * @since 0.0.1
	 *
	 * @param string  $key             Option key to get.
	 * @param bool    $return_default  Return default value.
	 *
	 * @return multi Value of given option or an empty string if option does not exist.
	 */
	public function get_post_option_value( $key, $return_default = false ) {

		$post_option = $this->get_post_option( $key );

		if ( ! empty( $post_option['value'] ) ) {

			return $post_option['value'];

		} else {

			return '';

		}

	} // End get_post_option_value


	/**
	 * Add option to $post_options_array property
	 * @since 0.0.1
	 *
	 * @param string  $option_key   Option key to get.
	 * @param array   $option_args  Options args see $options_defaults
	 *
	 */
	public function add_option( $option_key, $option_args = array() ) {

		$this->set_options_defaults( $option_key, $option_args );

	} // End add_option


	/**
	 * Add an array of option to post_options_array and set defaults
	 * @since 0.0.1
	 *
	 * @param array $options_array Array of options by key or assoc.
	 */
	public function add_options( array $options_array ) {

		foreach ( $options_array as $option_key => $option_args ) {

			if ( ! is_array( $option_args ) ) {

				$this->add_option( $option_args );

			} else {

				$this->add_option( $option_key, $option_args );

			} // End if
		} // End foreach
	} // End add_options

} // End add_options
