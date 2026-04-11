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

/**
 * Registers header strings for Polylang translations.
 */
function pontus_register_polylang_header_strings(): void
{
	if (!function_exists('pll_register_string')) {
		return;
	}

	$topbar_text = pontus_get_header_setting('topbar_text', '');

	if (is_string($topbar_text) && $topbar_text !== '') {
		pll_register_string(
			'pontus_topbar_text',
			$topbar_text,
			'pontus-zenergija',
			true
		);
	}
}
add_action('admin_init', 'pontus_register_polylang_header_strings');

/**
 * Returns translated topbar text when Polylang is active.
 */
function pontus_get_translated_topbar_text(string $default = ''): string
{
	$text = pontus_get_header_setting('topbar_text', $default);

	if (!is_string($text) || $text === '') {
		return $default;
	}

	if (function_exists('pll__')) {
		return pll__($text);
	}

	return $text;
}