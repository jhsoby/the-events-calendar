<?php
/**
 * View: Elementor Event Organizer widget header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-organizer/details/website/content.php
 *
 * @since TBD
 *
 * @var array  $organizer The organizer ID.
 * @var array  $settings  The widget settings.
 * @var int    $event_id  The event ID.
 * @var Tribe\Events\Pro\Integrations\Elementor\Widgets\Event_Organizer $widget The widget instance.
 */

$website = ! $this->get_widget()->should_show_mock_data() ? tribe_get_organizer_website_link( $organizer ) : 'http://theeventscalendar.com';
?>
<p <?php tribe_classes( $widget->get_website_base_class() ); ?>><?php echo wp_kses_post( $website ); ?></p>
