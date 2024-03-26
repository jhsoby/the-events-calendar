<?php
/**
 * View: Elementor Event Tags widget header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-tags/header.php
 *
 * @since TBD
 *
 * @var string $alignment   The text alignment.
 * @var bool   $show        Whether to show the heading.
 * @var string $heading_tag The HTML tag for the heading.
 * @var string $label_text  The label text.
 * @var array  $settings    The widget settings.
 * @var int    $event_id    The event ID.
 * @var Tribe\Events\Pro\Integrations\Elementor\Widgets\Event_Tags $widget The widget instance.
 */

if ( ! $show ) {
	return;
}
?>
<<?php echo tag_escape( $heading_tag ); ?> <?php tribe_classes( $widget->get_label_class() ); ?>class="tec-events-pro-event-tags-label">
	<?php echo esc_html( $label_text ); ?>
</<?php echo tag_escape( $heading_tag ); ?>>
