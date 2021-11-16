<?php
/**
 * The base implementation for the Views v2 query controllers.
 *
 * @package Tribe\Events\Views\V2\iCalendar
 * @since TBD
 */

namespace Tribe\Events\Views\V2\iCalendar\Links;

/**
 * Class Link_Interface
 *
 * @package Tribe\Events\Views\V2\iCalendar
 * @since TBD
 */
interface Link_Interface {
	/**
	 * Adds a subscribe link object to the list of links for template consumption.
	 *
	 * @since TBD
	 *
	 * @param array                       $template_vars The template variables.
	 * @param \Tribe\Events\Views\V2\View $view          The current View object.
	 *
	 * @return array $template_vars The modified vars.
	 */
	public function filter_tec_views_v2_subscribe_links( $template_vars, $view );

	/**
	 * Adds a link to those displayed on the single event view.
	 *
	 * @since TBD
	 *
	 * @param array<string>               $links The current list of links.
	 * @param \Tribe\Events\Views\V2\View $view  The current View object.
	 *
	 * @return array<string> $links The modified list of links.
	 */
	public function filter_tec_views_v2_single_subscribe_links( $links, $view );

	/**
	 * Getter function for the display property.
	 *
	 * @since TBD
	 *
	 * @param \Tribe\Events\Views\V2\View $view The current View object.
	 *
	 * @return boolean
	 */
	public static function is_visible( \Tribe\Events\Views\V2\View $view );

	/**
	 * Setter function for the display property.
	 *
	 * @since TBD
	 *
	 * @param boolean $visible
	 */
	public static function set_visibility( bool $visible );

	/**
	 * Getter function for the label property.
	 *
	 * @since TBD
	 *
	 * @param \Tribe\Events\Views\V2\View $view The current View object.
	 *
	 * @return string The translated link text/label.
	 */
	public static function get_label( \Tribe\Events\Views\V2\View $view );

	/**
	 * Getter function for the single label property.
	 *
	 * @since TBD
	 *
	 * @param \Tribe\Events\Views\V2\View $view The current View object.
	 *
	 * @return string The translated link text/label for the single event view.
	 */
	public static function get_single_label( \Tribe\Events\Views\V2\View $view );

	/**
	 * Getter function for the uri property.
	 *
	 * @since TBD
	 *
	 * @param \Tribe\Events\Views\V2\View $view The current View object.
	 *
	 * @return string The url for the link calendar subscription "feed", or download.
	 */
	public function get_uri( \Tribe\Events\Views\V2\View $view );
}
