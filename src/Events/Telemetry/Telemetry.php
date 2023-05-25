<?php
/**
 * Class that handles interfacing with TEC\Common\Telemetry.
 *
 * @since   TBD
 *
 * @package TEC\Events\Telemetry
 */

namespace TEC\Events\Telemetry;

use TEC\Common\StellarWP\Telemetry\Config;
use TEC\Common\StellarWP\Telemetry\Opt_In\Status;
use TEC\Common\Telemetry\Telemetry as Common_Telemetry;
use Tribe\Events\Admin\Settings as Plugin_Settings;
use Tribe__Events__Main;

/**
 * Class Telemetry
 *
 * @since   TBD

 * @package TEC\Events\Telemetry
 */
class Telemetry {

	/**
	 * The Telemetry plugin slug for The Events Calendar.
	 *
	 * @since TBD
	 *
	 * @var string
	 */
	protected static $plugin_slug = 'the-events-calendar';

	/**
	 * The "plugin path" for The Events Calendar main file.
	 *
	 * @since TBD
	 *
	 * @var string
	 */
	protected static $plugin_path = 'the-events-calendar.php';

	/**
	 * Filters the modal optin args to be specific to TEC
	 *
	 * @since TBD
	 *
	 * @param array<string|mixed> $original_optin_args The original args, provided by Common.
	 *
	 * @return array<string|mixed> The filtered args.
	 */
	public function filter_tec_common_telemetry_optin_args( $original_optin_args ): array {
		// wp-admin/admin.php?page=tec-events-settings
		if ( ! tribe( Plugin_Settings::class )->is_tec_events_settings() ) {
			return $original_optin_args;
		}

		$intro_message = sprintf(
			/* Translators: %1$s - the user name. */
			__( 'Hi, %1$s! This is an invitation to help our StellarWP community.', 'the-events-calendar' ),
			wp_get_current_user()->display_name // escaped after string is assembled, below.
		);

		$intro_message .= ' ' . __( 'If you opt-in, some data about your usage of The Events Calendar and future StellarWP Products will be shared with our teams (so they can work their butts off to improve).' , 'the-events-calendar');
		$intro_message .= ' ' . __( 'We will also share some helpful info on WordPress, and our products from time to time.' , 'the-events-calendar');
		$intro_message .= ' ' . __( 'And if you skip this, that’s okay! Our products still work just fine.', 'the-events-calendar' );

		$tec_optin_args = [
			'plugin_logo_alt' => 'The Events Calendar Logo',
			'plugin_name'     => 'The Events Calendar',
			'heading'         => __( 'We hope you love The Events Calendar!', 'the-events-calendar' ),
			'intro'           => esc_html( $intro_message )
		];

		return array_merge( $original_optin_args, $tec_optin_args );
	}

	/**
	 * Adds the opt in/out control to the general tab debug section.
	 *
	 * @since TBD
	 *
	 * @param array<string|mixed> $fields The fields for the general tab Debugging section.
	 *
	 * @return array<string|mixed> The fields, with the optin control appended.
	 */
	public function filter_tribe_general_settings_debugging_section( $fields ): array {
		$status = Config::get_container()->get( Status::class );
		$opted = $status->get( self::$plugin_slug );

		switch( $opted ) {
			case $status::STATUS_ACTIVE :
				$label = esc_html_x( 'Opt out of Telemetry', 'Settings label for opting out of Telemetry.', 'the-events-calendar' );
			default :
				$label = esc_html_x( 'Opt in to Telemetry', 'the-events-calendar' );
		}


		$fields['opt-in-status'] = [
			'type'            => 'checkbox_bool',
			'label'           => $label,
			'tooltip'         => sprintf(
				/* Translators: Description of the Telemetry optin setting.
				%1$s: opening anchor tag for permissions link.
				%2$s: opening anchor tag for terms of service link.
				%3$s: opening anchor tag for privacy policy link.
				%4$s: closing anchor tags.
				*/
				_x(
					'Enable this option to share usage data with The Events Calendar and StellarWP. %1$sWhat permissions are being granted?%4$s %2$sRead our terms of service%4$s. %3$sRead our privacy policy%4$s.',
					'Description of optin setting.',
					'the-events-calendar'
				),
				'<a href=" ' . Common_Telemetry::get_permissions_url() . ' ">',
				'<a href=" ' . Common_Telemetry::get_terms_url() . ' ">',
				'<a href=" ' . Common_Telemetry::get_privacy_url() . ' ">',
				'</a>'
			),
			'default'         => false,
			'validation_type' => 'boolean',
		];

		return $fields;
	}

	/**
	 * Ensures the admin control reflects the actual opt-in status.
	 * We save this value in tribe_options but since that could get out of sync,
	 * we always display the status from TEC\Common\StellarWP\Telemetry\Opt_In\Status directly.
	 *
	 * @since TBD
	 *
	 * @param mixed  $value  The value of the attribute.
	 * @param string $field  The field object id.
	 *
	 * @return mixed $value
	 */
	public function filter_tribe_field_opt_in_status( $value, $id ) {
		if ( 'opt-in-status' !== $id ) {
			return $value;
		}

		// We don't care what the value stored in tribe_options is - give us Telemetry's Opt_In\Status value.
		$status = Config::get_container()->get( Status::class );
		// Rather than test for STATUS_ACTIVE, we just make sure it's not inactive (as there is also a "mixed" status)
		$value = $status->get() !== $status::STATUS_INACTIVE;

		return $value;
	}

	/**
	 * Adds The Events Calendar to the list of plugins
	 * to be opted in/out alongside tribe-common.
	 *
	 * @since TBD
	 *
	 * @param array<string,string> $slugs The default array of slugs in the format  [ 'plugin_slug' => 'plugin_path' ]
	 *
	 * @see \TEC\Common\Telemetry\Telemetry::get_tec_telemetry_slugs()
	 *
	 * @return array<string,string> $slugs The same array with The Events Calendar added to it.
	 */
	public function filter_tec_telemetry_slugs( $slugs ) {
		$dir = Tribe__Events__Main::instance()->plugin_dir;
		$slugs[ static::$plugin_slug ] =  $dir . static::$plugin_path;
		return array_unique( $slugs, SORT_STRING );
	}
}
