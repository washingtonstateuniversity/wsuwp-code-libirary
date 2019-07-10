<?php namespace WSUWP\Code_Library;


class Metabox_Name {

	private $nonce_name = 'wsuwp_nounce_name_changeme';
	private $nonce_action = 'wsuwp_nounce_action_name_changeme';
	private $post_options;
	private $object_changeme;

	private $screens = array( 'post' );


	public function __construct( Post_Options $post_options, Object_Class $object_changeme ) {

		$this->post_options    = $post_options;
		$this->object_changeme = $object_changeme;

	}


	public function setup() {

		add_action( 'add_meta_boxes', array( $this, 'register_metabox' ) );

		foreach ( $this->screens as $screen ) {

			add_action( 'save_post_' . $screen, array( $this, 'save_post' ), 10, 3 );

		} // End foreach

		if ( is_admin() ) {

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_metabox_scripts' ) );

		} // End if

	} // End setup_plugin


	public function enqueue_metabox_scripts( $hook ) {

		if ( false !== strpos( $hook, 'post.php' ) ) {

			//$metabox_css_src = Utilities::get_plugin_src_url( 'css/metabox.css' );
			//$metabox_js_src  = Utilities::get_plugin_src_url( 'js/metabox.js' );

			//wp_enqueue_style( 'social_metabox_css', $metabox_css_src, array(), '0.0.1', false );
			//wp_enqueue_script( 'social_metabox_js', $metabox_js_src, array(), '0.0.1', true );

		}

	} // End enqueue_metabox_scripts


	public function save_post( $post_id, $post, $update ) {

		$save_options = $this->post_options->get_post_options_array();

		$save_post = new Save_Post( $save_options, $this->nonce_action . '_' . $post_id, $this->nonce_name );

		$save_post->save_post( $post_id, $post, $update );

		//$this->update_post( $save_post, $post_id, $post, $update );

	}


	/*private function update_post( Save_Post $save_post, $post_id, $post, $update ) {

		foreach ( $this->screens as $screen ) {

			remove_action( 'save_post_' . $screen, array( $this, 'save_post' ), 10, 3 );

		} // End foreach

		if ( true === $save_post->check_can_save( $post_id, $post, $update ) ) {

			// Do something that updates the post using wp_update_post()

		} // End if

	} // End update_post */


	public function register_metabox() {

		$screens = $this->screens;

		foreach ( $screens as $screen ) {

			add_meta_box(
				'metabox_id_changeme', // Unique ID
				'metabox_id_changeme',  // Box title
				array( $this, 'the_metabox' ),  // Content callback, must be of type callable
				$screen // Post type
			);

		} // End foreach

	} // End register_metabox


	public function the_metabox( $post ) {

		wp_nonce_field( $this->nonce_action . '_' . $post->ID, $this->nonce_name );

		//$this->object_class_changeme->set_by_post_id( $post->ID );

		//$property_1_changeme = $this->object_class_changeme->get_property_1_changeme();
		//$property_2_changeme = $this->object_class_changeme->get_property_2_changeme();

		//include Utilities::get_plugin_component_path( 'metabox/something_changeme.php' );
		//include Utilities::get_plugin_component_path( 'metabox/something_changeme.php' );

	} // End the_social_share_metabox


}
