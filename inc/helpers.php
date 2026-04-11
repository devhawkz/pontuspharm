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
 * Post ID for ACF fields on the static front page (Polylang-aware).
 *
 * @return int 0 when the homepage is the blog index, not a static page.
 */
function pontus_get_front_page_acf_post_id(): int
{
	if (get_option('show_on_front') !== 'page') {
		return 0;
	}

	$id = (int) get_option('page_on_front');

	if ($id <= 0) {
		return 0;
	}

	if (function_exists('pll_get_post') && function_exists('pll_current_language')) {
		$lang = pll_current_language('slug');

		if (is_string($lang) && $lang !== '') {
			$translated = pll_get_post($id, $lang);

			if (is_numeric($translated) && (int) $translated > 0) {
				return (int) $translated;
			}
		}
	}

	return $id;
}

/**
 * Returns a field value from the header settings page.
 *
 * @param string $field_name Field name.
 * @param mixed  $default    Default value.
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
 * @param string $field_name Field name.
 * @param mixed  $default    Default value.
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
 *
 * @param string $name  String key.
 * @param mixed  $value String value.
 * @param string $group String group.
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
 * Returns translated dynamic string when Polylang is active.
 *
 * @param mixed  $value   Original string value.
 * @param string $default Default fallback.
 */
function pontus_translate_dynamic_string($value, string $default = ''): string
{
	if (!is_string($value) || trim($value) === '') {
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
 * @param mixed $post_id Saved post ID.
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
 * Returns translated footer field value.
 */
function pontus_get_translated_footer_setting(string $field_name, string $default = ''): string
{
	$value = pontus_get_footer_setting($field_name, $default);

	return pontus_translate_dynamic_string($value, $default);
}

/**
 * Returns related author CPT ID for a post.
 */
function pontus_get_post_author_profile_id(?int $post_id = null): int
{
	$post_id = $post_id ?: get_the_ID();

	if (!$post_id || !function_exists('get_field')) {
		return 0;
	}

	$author_value = get_field('post_author_profile', $post_id);

	if (empty($author_value)) {
		return 0;
	}

	if ($author_value instanceof WP_Post) {
		$author_id = (int) $author_value->ID;
	} elseif (is_array($author_value)) {
		if (!empty($author_value['ID'])) {
			$author_id = (int) $author_value['ID'];
		} elseif (!empty($author_value[0]) && $author_value[0] instanceof WP_Post) {
			$author_id = (int) $author_value[0]->ID;
		} elseif (!empty($author_value[0]) && is_numeric($author_value[0])) {
			$author_id = (int) $author_value[0];
		} else {
			$author_id = 0;
		}
	} elseif (is_numeric($author_value)) {
		$author_id = (int) $author_value;
	} else {
		$author_id = 0;
	}

	if (!$author_id) {
		return 0;
	}

	if (function_exists('pll_get_post') && function_exists('pll_current_language')) {
		$current_lang = pll_current_language('slug');

		if ($current_lang) {
			$translated_author_id = pll_get_post($author_id, $current_lang);

			if (!empty($translated_author_id)) {
				$author_id = (int) $translated_author_id;
			}
		}
	}

	return $author_id;
}

/**
 * Returns author CPT title.
 */
function pontus_get_post_author_name(?int $post_id = null): string
{
	$author_id = pontus_get_post_author_profile_id($post_id);

	if (!$author_id) {
		return '';
	}

	$name = get_the_title($author_id);

	return is_string($name) ? trim($name) : '';
}

/**
 * Returns short author impressum/bio from author CPT.
 */
function pontus_get_post_author_short_bio(?int $post_id = null): string
{
	$author_id = pontus_get_post_author_profile_id($post_id);

	if (!$author_id || !function_exists('get_field')) {
		return '';
	}

	$bio = get_field('author_short_bio', $author_id);

	return is_string($bio) ? trim($bio) : '';
}

/**
 * Returns author title from author CPT.
 */
function pontus_get_post_author_title(?int $post_id = null): string
{
	$author_id = pontus_get_post_author_profile_id($post_id);

	if (!$author_id || !function_exists('get_field')) {
		return '';
	}

	$title = get_field('author_title', $author_id);

	return is_string($title) ? trim($title) : '';
}

/**
 * Returns author permalink.
 */
function pontus_get_post_author_permalink(?int $post_id = null): string
{
	$author_id = pontus_get_post_author_profile_id($post_id);

	if (!$author_id) {
		return '';
	}

	$link = get_permalink($author_id);

	return is_string($link) ? $link : '';
}

/**
 * Returns primary category term for a post.
 */
function pontus_get_post_primary_category(?int $post_id = null): ?WP_Term
{
	$post_id = $post_id ?: get_the_ID();

	if (!$post_id) {
		return null;
	}

	$terms = get_the_category($post_id);

	if (empty($terms) || !is_array($terms)) {
		return null;
	}

	return $terms[0] instanceof WP_Term ? $terms[0] : null;
}

/**
 * Returns lead/excerpt for a post card.
 */
function pontus_get_post_card_excerpt(?int $post_id = null, int $word_limit = 24): string
{
	$post_id = $post_id ?: get_the_ID();

	if (!$post_id) {
		return '';
	}

	$lead = '';

	if (function_exists('get_field')) {
		$lead = get_field('post_lead', $post_id);

		if (!is_string($lead)) {
			$lead = '';
		}
	}

	if ($lead === '') {
		$lead = has_excerpt($post_id) ? get_the_excerpt($post_id) : get_post_field('post_excerpt', $post_id);
	}

	if (!is_string($lead) || trim($lead) === '') {
		$lead = wp_strip_all_tags(get_post_field('post_content', $post_id));
	}

	$lead = trim(wp_strip_all_tags($lead));

	if ($lead === '') {
		return '';
	}

	return wp_trim_words($lead, $word_limit, '…');
}

/**
 * Returns reading time label using plugin helper if available.
 */
function pontus_get_post_reading_time_label(?int $post_id = null): string
{
	$post_id = $post_id ?: get_the_ID();

	if (!$post_id) {
		return '';
	}

	if (function_exists('pontus_core_get_reading_time_label')) {
		return pontus_core_get_reading_time_label($post_id);
	}

	$content = get_post_field('post_content', $post_id);

	if (!is_string($content) || $content === '') {
		return '';
	}

	$minutes = max(1, (int) ceil(str_word_count(wp_strip_all_tags($content)) / 200));

	return sprintf(
		/* translators: %d: number of minutes */
		_n('%d min čitanja', '%d min čitanja', $minutes, 'pontus-zenergija'),
		$minutes
	);
}