<?php
/*Plugin class that displays data on pages or posts depending on certain constants*/
class WpPlugin {
	/*
	 * Registering hooks for the script to work
	 */
	public function __construct() {
		add_action( 'wp_ajax_get_records', array( $this, 'get_records' ) );
		add_action( 'wp_ajax_nopriv_oldest_posts', array( $this, 'get_records' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}
/*
 * Gets the required records from the database, depending on the settings of the WPPLUGIN_RECORDS_TYPE constant
 *  and sends them to the frontend
 */
	public function get_records() {

		$oldest_posts = get_posts( array(
			'post_type'      => WPPLUGIN_RECORDS_TYPE,
			'orderby'        => 'date',
			'order'          => WPPLUGIN_SORT_OF_RECORDS,
			'posts_per_page' => WPPLUGIN_NUMER_OF_RECORDS
		) );

		$posts_html = '';
		foreach ( $oldest_posts as $post ) {
			$posts_html .= '<h2>' . $post->post_title . '</h2>';
			$posts_html .= '<div class="post-content">' . apply_filters( 'the_content', $post->post_content ) . '</div>';
		}

		wp_send_json_success( $posts_html );
	}

	/*
	 * Registration of scripts depending on the setting of the WPPLUGIN_RECORDS_TYPE constant,
	 *  the script is loaded only on the required pages
	 */
	public function enqueue_scripts() {
		switch ( WPPLUGIN_RECORDS_TYPE ) {
			case WPPLUGIN_RECORDS_TYPE_POST:
				if(is_page()) {
					$this->registerScript();
				}
				break;
			case WPPLUGIN_RECORDS_TYPE_PAGE:
				if(is_single()) {
					$this->registerScript();
				}
				break;
		}
	}

	/*
	 * Frontend java script upload function
	 */
	private function registerScript(){
		wp_enqueue_script( 'test-plugin', plugin_dir_url( __FILE__ ) . 'public/js/test-plugin.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'test-plugin', 'oldestPostsAjax', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'oldest_posts_nonce' ),
		) );
	}
}
