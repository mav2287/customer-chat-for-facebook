<?php

/**
 * Controls settings of plugin
 *
 * @package    Facebook_Customer_Chat
 * @subpackage Facebook_Customer_Chat/admin/settings
 */
class Facebook_Customer_Chat_Settings extends Facebook_Customer_Chat_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Facebook_Customer_Chat    The ID of this plugin.
	 */
	private $Facebook_Customer_Chat;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $Facebook_Customer_Chat       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $Facebook_Customer_Chat ) {
		$this->id    = 'general';
		$this->label = __( 'General', 'woocommerce' );
		$this->Facebook_Customer_Chat = $Facebook_Customer_Chat;
	}

	/**
	 * Creates our settings sections with fields etc.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function settings_api_init() {
		$this->settings_post_api_init();
	}

	/**
	 * Creates post settings sections with fields etc.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function settings_post_api_init() {

		// Example usage:
		// register_setting( $option_group, $option_name, $settings_sanitize_callback );
		register_setting(
			$this->Facebook_Customer_Chat . '_options',
			$this->Facebook_Customer_Chat . '_options',
			array( $this, 'settings_sanitize' )
		);

		// Example usage:
		// add_settings_section( $id, $title, $callback, $menu_slug );
		add_settings_section(
			$this->Facebook_Customer_Chat . '-display-options', // section
			apply_filters( $this->Facebook_Customer_Chat . '-display-section-title', __( '', $this->Facebook_Customer_Chat ) ),
			array( $this, 'display_options_section' ),
			$this->Facebook_Customer_Chat
		);

		// Example usage:
		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

    add_settings_field(
			'facebook-page-id',
			apply_filters( $this->Facebook_Customer_Chat . '-facebook-page-id-label', __( 'Facebook Page ID', $this->Facebook_Customer_Chat ) ),
			array( $this, 'facebook_page_id' ),
			$this->Facebook_Customer_Chat,
			$this->Facebook_Customer_Chat . '-display-options' // section to add to
		);

    add_settings_field(
			'facebook-app-id',
			apply_filters( $this->Facebook_Customer_Chat . '-facebook-app-id-label', __( 'Facebook App ID', $this->Facebook_Customer_Chat ) ),
			array( $this, 'facebook_app_id' ),
			$this->Facebook_Customer_Chat,
			$this->Facebook_Customer_Chat . '-display-options' // section to add to
		);

		add_settings_field(
			'minimized',
			apply_filters( $this->Facebook_Customer_Chat . '-minimized-label', __( 'Is Minimized', $this->Facebook_Customer_Chat ) ),
			array( $this, 'minimized_options_field' ),
			$this->Facebook_Customer_Chat,
			$this->Facebook_Customer_Chat . '-display-options' // section to add to
		);
	}

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function display_options_section( $params ) {

		echo '<p>' . $params['title'] . '</p>';

	} // display_options_section()

  /**
   * Facebook Page ID
   *
   * @since 		1.0.0
   * @return 		mixed 			The settings field
   */
  public function facebook_page_id() {

    $options 	= get_option( $this->Facebook_Customer_Chat . '_options' );
    $option 	= '';

    if ( ! empty( $options['facebook-page-id'] ) ) {
      $option = $options['facebook-page-id'];
    }

    ?><input type="text" id="<?php echo $this->Facebook_Customer_Chat; ?>_options[facebook-page-id]" name="<?php echo $this->Facebook_Customer_Chat; ?>_options[facebook-page-id]" value="<?php echo $option; ?>" />
    <p class="description">
      Facebook ID of page to message
      <a href="https://findmyfbid.com/" target="_blank">Get it</a>
    </p> <?php
  } // facebook_page_id()

  /**
   * Facebook App ID
   *
   * @since 		1.0.0
   * @return 		mixed 			The settings field
   */
  public function facebook_app_id() {

    $options 	= get_option( $this->Facebook_Customer_Chat . '_options' );
    $option 	= '735243603333999';

    if ( ! empty( $options['facebook-app-id'] ) ) {
      $option = $options['facebook-app-id'];
    }

    ?><input type="text" id="<?php echo $this->Facebook_Customer_Chat; ?>_options[facebook-app-id]" name="<?php echo $this->Facebook_Customer_Chat; ?>_options[facebook-app-id]" value="<?php echo $option; ?>" />
    <p class="description">
      Facebook App ID to identify this website for Facebook
      <a href="https://developers.facebook.com/apps/" target="_blank">Create a new App</a>
    </p> <?php
  } // facebook_page_id()

	/**
	 * Enable Filter Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function minimized_options_field() {

		$options 	= get_option( $this->Facebook_Customer_Chat . '_options' );
		$option 	= 0;

		if ( ! empty( $options['minimized'] ) ) {
			$option = $options['minimized'];
		}

		?><input type="checkbox" id="<?php echo $this->Facebook_Customer_Chat; ?>_options[minimized]" name="<?php echo $this->Facebook_Customer_Chat; ?>_options[minimized]" value="1" <?php checked( $option, 1 , true ); ?> />
		<p class="description">
      Messenger shows a welcome message. <a href="https://i.imgur.com/5zknx0Y.png" target="_blank">What's the difference?</a>
      <br />
      *Keep in mind that after the user minimizes it, it will stay minimized regardless of this setting.
    </p> <?php
	} // minimized_options_field()

}
