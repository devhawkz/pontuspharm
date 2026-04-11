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

	wp_enqueue_script(
		'pontus-header',
		$theme_uri . '/assets/js/header.js',
		[],
		pontus_asset_version('/assets/js/header.js'),
		true
	);
}
add_action('wp_enqueue_scripts', 'pontus_enqueue_assets');