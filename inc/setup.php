<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Theme setup.
 */
function pontus_theme_setup(): void
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	]);
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

	register_nav_menus([
		'primary_menu' => __('Primary Menu', 'pontus-zenergija'),
	]);
}
add_action('after_setup_theme', 'pontus_theme_setup');

