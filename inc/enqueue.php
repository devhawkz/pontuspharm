<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Returns asset version based on file modification time.
 *
 * @param string $relative_path Relative path from theme root.
 * @return string
 */
function pontus_asset_version(string $relative_path): string
{
	$file_path = get_template_directory() . $relative_path;

	if (file_exists($file_path)) {
		return (string) filemtime($file_path);
	}

	return wp_get_theme()->get('Version');
}

/**
 * Enqueues front-page section CSS only when ACF matches the same rules as each template part.
 */
function pontus_enqueue_front_page_section_styles(string $theme_uri): void
{
	$enqueue = static function (string $handle, string $relative_path) use ($theme_uri): void {
		wp_enqueue_style(
			$handle,
			$theme_uri . $relative_path,
			['pontus-tokens'],
			pontus_asset_version($relative_path)
		);
	};

	if (!function_exists('get_field')) {
		return;
	}

	$acf_post_id = pontus_get_front_page_acf_post_id();

	$get = static function (string $name) use ($acf_post_id) {
		return $acf_post_id > 0 ? get_field($name, $acf_post_id) : get_field($name);
	};

	// Blog kao početna: nema page_on_front — ne možemo pouzdano čitati ACF sa iste lokacije kao šabloni.
	if ($acf_post_id === 0) {
		foreach (
			[
				'pontus-about-brand-section'  => '/assets/css/about-brand-section.css',
				'pontus-newsletter-section'   => '/assets/css/newsletter-section.css',
				'pontus-highlight-section'    => '/assets/css/highlight-section.css',
				'pontus-values-section'        => '/assets/css/values-section.css',
				'pontus-testimonials-section'  => '/assets/css/testimonials-section.css',
				'pontus-blog-section'         => '/assets/css/blog-section.css',
				'pontus-instagram-section'     => '/assets/css/instagram-section.css',
			] as $handle => $path
		) {
			$enqueue($handle, $path);
		}

		return;
	}

	if ($get('about_brand_section_enabled')) {
		$enqueue('pontus-about-brand-section', '/assets/css/about-brand-section.css');
	}

	if ($get('newsletter_section_enabled') && !empty($get('newsletter_section_shortcode'))) {
		$enqueue('pontus-newsletter-section', '/assets/css/newsletter-section.css');
	}

	if ($get('highlights_section_enabled')) {
		$enqueue('pontus-highlight-section', '/assets/css/highlight-section.css');
	}

	if ($get('values_section_enabled')) {
		$enqueue('pontus-values-section', '/assets/css/values-section.css');
	}

	if ($get('testimonials_section_enabled')) {
		$enqueue('pontus-testimonials-section', '/assets/css/testimonials-section.css');
	}

	if ($get('home_blog_section_enabled')) {
		$enqueue('pontus-blog-section', '/assets/css/blog-section.css');
	}

	if ($get('instagram_section_enabled')) {
		$has_image = false;

		for ($i = 1; $i <= 6; $i++) {
			if (!empty($get('instagram_post_image_' . $i))) {
				$has_image = true;
				break;
			}
		}

		if ($has_image) {
			$enqueue('pontus-instagram-section', '/assets/css/instagram-section.css');
		}
	}
}

/**
 * Enqueue theme assets.
 */
function pontus_enqueue_assets(): void
{
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style(
		'pontus-tokens',
		$theme_uri . '/assets/css/tokens.css',
		[],
		pontus_asset_version('/assets/css/tokens.css')
	);

	wp_enqueue_style(
		'pontus-header',
		$theme_uri . '/assets/css/header.css',
		['pontus-tokens'],
		pontus_asset_version('/assets/css/header.css')
	);

	wp_enqueue_style(
		'pontus-footer',
		$theme_uri . '/assets/css/footer.css',
		['pontus-tokens'],
		pontus_asset_version('/assets/css/footer.css')
	);

	if (is_front_page()) {
		pontus_enqueue_front_page_section_styles($theme_uri);
	}

	wp_enqueue_script(
		'pontus-header',
		$theme_uri . '/assets/js/header.js',
		[],
		pontus_asset_version('/assets/js/header.js'),
		true
	);
}
add_action('wp_enqueue_scripts', 'pontus_enqueue_assets');