<?php namespace WSUWP\Code_Library;

/**
 * Use this class to define options from the settings API.
 *
 * @version: 0.0.1
 */

class Site_Options {


	protected $options_defaults = array(
		'default_value' => '',
		'value'         => false,
	);


	protected $is_set = false;


	protected $wsuwp_options = array();


	public function set_wsuwp_options( $force_update = false ) {

		if ( $this->is_set && ! $force_update ) {

			return true;

		} // End if

		$set_options = get_option( 'wsuwp' );

		if ( ! is_array( $set_options ) ) {

			$set_options = array();

		} // End if

		$wsuwp_options = $this->get_wsuwp_options();

		foreach ( $wsuwp_options as $option_key => $option_args ) {

			$option_args = array_merge( $this->options_defaults, $option_args );

			if ( array_key_exists( $option_key, $set_options ) ) {

				$option_args['value'] = $set_options[ $option_key ];

				$this->wsuwp_options[ $option_key ] = $option_args;

			} // End if
		} // End foreach

		$this->is_set = true;

		return true;

	} // End set_wsuwp_options


	public function get_wsuwp_options() {

		return $this->wsuwp_options;

	} // End get_wsuwp_option


	public function get_wsuwp_option( $key, $return_default = true ) {

		$this->set_wsuwp_options();

		$wsuwp_options = $this->get_wsuwp_options();

		if ( array_key_exists( $key, $wsuwp_options ) ) {

			$value = ( isset( $wsuwp_options[ $key ]['value'] ) ) ? $wsuwp_options[ $key ]['value'] : false;

			if ( false !== $value ) {

				return $value;

			} elseif ( $return_default && isset( $wsuwp_options[ $key ]['default_value'] ) ) {

				return $wsuwp_options[ $key ]['default_value'];

			} else {

				return '';

			} // End if
		} else {

			return '';

		} // End if

	} // End get_wsuwp_option
}
