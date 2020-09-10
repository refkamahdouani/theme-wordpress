<?php



class SenpaiOptions {
	private $senpai_options_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'senpai_options_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'senpai_options_page_init' ) );
	}

	public function senpai_options_add_plugin_page() {
		add_options_page(
			'senpai options', // page_title
			'senpai options', // menu_title
			'manage_options', // capability
			'senpai-options', // menu_slug
			array( $this, 'senpai_options_create_admin_page' ) // function
		);
	}

	public function senpai_options_create_admin_page() {
		$this->senpai_options_options = get_option( 'senpai_options_option_name' ); ?>

		<div class="wrap">
			<h2>senpai options</h2>
			<p>Senpai option page</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'senpai_options_option_group' );
					do_settings_sections( 'senpai-options-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function senpai_options_page_init() {
		register_setting(
			'senpai_options_option_group', // option_group
			'senpai_options_option_name', // option_name
			array( $this, 'senpai_options_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'senpai_options_setting_section', // id
			'Settings', // title
			array( $this, 'senpai_options_section_info' ), // callback
			'senpai-options-admin' // page
		);

		add_settings_field(
			'footer_credentials', // id
			'Footer credentials', // title
			array( $this, 'footer_credentials_callback' ), // callback
			'senpai-options-admin', // page
			'senpai_options_setting_section' // section
		);

	}

	public function senpai_options_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['footer_credentials'] ) ) {
			$sanitary_values['footer_credentials'] = esc_textarea( $input['footer_credentials'] );
		}

		return $sanitary_values;
	}

	public function senpai_options_section_info() {
		
	}

	public function footer_credentials_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="senpai_options_option_name[footer_credentials_0]" id="footer_credentials_0">%s</textarea>',
			isset( $this->senpai_options_options['footer_credentials'] ) ? esc_attr( $this->senpai_options_options['footer_credentials']) : ''
		);
	}



}
if ( is_admin() )
	$senpai_options = new SenpaiOptions();

/* 
 * Retrieve this value with:
 * $senpai_options_options = get_option( 'senpai_options_option_name' ); // Array of All Options
 * $footer_credentials_0 = $senpai_options_options['footer_credentials_0']; // Footer credentials
 * $footer_credentials_1 = $senpai_options_options['footer_credentials_1']; // Footer credentials
 */
