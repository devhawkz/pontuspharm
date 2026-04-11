<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Returns the page ID used for header settings.
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
 * Returns the page ID used for footer settings.
 */
function pontus_get_footer_settings_page_id(): int
{
	$page = get_page_by_path('footer-settings');

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
 * Returns a field value from the footer settings page.
 *
 * @param string $field_name
 * @param mixed  $default
 * @return mixed
 */
function pontus_get_footer_setting(string $field_name, $default = '')
{
	$page_id = pontus_get_footer_settings_page_id();

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
 * Registers a single dynamic string in Polylang.
 */
function pontus_register_polylang_string(string $name, $value, string $group = 'pontus-zenergija'): void
{
	if (!function_exists('pll_register_string')) {
		return;
	}

	if (!is_string($value) || $value === '') {
		return;
	}

	pll_register_string($name, $value, $group, true);
}

/**
 * Returns a translated dynamic string when Polylang is active.
 */
function pontus_translate_dynamic_string($value, string $default = ''): string
{
	if (!is_string($value) || $value === '') {
		return $default;
	}

	if (function_exists('pll__')) {
		return pll__($value);
	}

	return $value;
}

/**
 * Registers header strings for Polylang translations.
 */
function pontus_register_polylang_header_strings(): void
{
	$group = 'pontus-zenergija-header';

	pontus_register_polylang_string(
		'pontus_topbar_text',
		pontus_get_header_setting('topbar_text', ''),
		$group
	);
}
add_action('admin_init', 'pontus_register_polylang_header_strings');

/**
 * Registers footer strings for Polylang translations.
 */
function pontus_register_polylang_footer_strings(): void
{
	$group = 'pontus-zenergija-footer';

	$footer_strings = [
		'pontus_footer_brand_name'        => pontus_get_footer_setting('footer_brand_name', ''),
		'pontus_footer_about_title'       => pontus_get_footer_setting('footer_about_title', ''),
		'pontus_footer_about_text'        => pontus_get_footer_setting('footer_about_text', ''),
		'pontus_footer_info_title'        => pontus_get_footer_setting('footer_info_title', ''),
		'pontus_footer_address'           => pontus_get_footer_setting('footer_address', ''),
		'pontus_footer_support_title'     => pontus_get_footer_setting('footer_support_title', ''),
		'pontus_footer_support_text'      => pontus_get_footer_setting('footer_support_text', ''),
		'pontus_footer_back_to_top_label' => pontus_get_footer_setting('footer_back_to_top_label', ''),
		'pontus_footer_copyright'         => pontus_get_footer_setting('footer_copyright', ''),
		'pontus_footer_legal_label'       => pontus_get_footer_setting('footer_legal_label', ''),
		'pontus_footer_legal_url'         => pontus_get_footer_setting('footer_legal_url', ''),
		'pontus_footer_privacy_label'     => pontus_get_footer_setting('footer_privacy_label', ''),
		'pontus_footer_privacy_url'       => pontus_get_footer_setting('footer_privacy_url', ''),
		'pontus_footer_credit_text'       => pontus_get_footer_setting('footer_credit_text', ''),
	];

	foreach ($footer_strings as $name => $value) {
		pontus_register_polylang_string($name, $value, $group);
	}
}
add_action('admin_init', 'pontus_register_polylang_footer_strings');

/**
 * Re-registers strings after ACF settings pages are saved.
 *
 * @param mixed $post_id
 */
function pontus_reregister_polylang_strings_after_acf_save($post_id): void
{
	if (!is_numeric($post_id)) {
		return;
	}

	$post_id = (int) $post_id;

	if (
		$post_id !== pontus_get_header_settings_page_id() &&
		$post_id !== pontus_get_footer_settings_page_id()
	) {
		return;
	}

	pontus_register_polylang_header_strings();
	pontus_register_polylang_footer_strings();
}
add_action('acf/save_post', 'pontus_reregister_polylang_strings_after_acf_save', 20);

/**
 * Returns translated topbar text.
 */
function pontus_get_translated_topbar_text(string $default = ''): string
{
	$text = pontus_get_header_setting('topbar_text', $default);

	return pontus_translate_dynamic_string($text, $default);
}

/**
 * Returns translated footer field.
 */
function pontus_get_translated_footer_setting(string $field_name, string $default = ''): string
{
	$value = pontus_get_footer_setting($field_name, $default);

	return pontus_translate_dynamic_string($value, $default);
}