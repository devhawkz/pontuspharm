<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Returns the page ID used for header settings.
 *
 * Create a regular WordPress page with slug:
 * header-settings
 *
 * ACF field group should be assigned to that page.
 */
function pontus_get_header_settings_page_id(): int
{
	$page = get_page_by_path('header-settings');

	if (!$page instanceof WP_Post) {
		return 0;
	}

	return (int) $page->ID;
}

/**
 * Returns a field value from the header settings page.
 *
 * @param string $field_name
 * @param mixed  $default
 * @return mixed
 */
function pontus_get_header_setting(string $field_name, $default = '')
{
	$page_id = pontus_get_header_settings_page_id();

	if (!$page_id || !function_exists('get_field')) {
		return $default;
	}

	$value = get_field($field_name, $page_id);

	if ($value === null || $value === '') {
		return $default;
	}

	return $value;
}