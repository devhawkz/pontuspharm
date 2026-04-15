<?php
if (!defined('ABSPATH')) {
	exit;
}

// ---------------------------------------------------------------------------
// Data helpers
// ---------------------------------------------------------------------------

/**
 * Returns font family options shown in the Customizer selects.
 * Fonts without an entry in pontus_google_fonts_list() are treated as custom/locally-loaded.
 */
function pontus_get_font_choices(): array {
	return [
		'Montserrat'         => 'Montserrat',
		'Inter'              => 'Inter',
		'Lato'               => 'Lato',
		'Open Sans'          => 'Open Sans',
		'Raleway'            => 'Raleway',
		'Poppins'            => 'Poppins',
		'Nunito'             => 'Nunito',
		'Roboto'             => 'Roboto',
		'DM Sans'            => 'DM Sans',
		'Mulish'             => 'Mulish',
		'Josefin Sans'       => 'Josefin Sans',
		'Quicksand'          => 'Quicksand',
		'Playfair Display'   => 'Playfair Display',
		'Cormorant Garamond' => 'Cormorant Garamond',
		'Libre Baskerville'  => 'Libre Baskerville',
		'Lora'               => 'Lora',
		'Merriweather'       => 'Merriweather',
	];
}

function pontus_get_script_font_choices(): array {
	return [
		'Bestermind'     => 'Bestermind (Custom)',
		'Dancing Script' => 'Dancing Script',
		'Pacifico'       => 'Pacifico',
		'Sacramento'     => 'Sacramento',
		'Great Vibes'    => 'Great Vibes',
		'Allura'         => 'Allura',
		'Satisfy'        => 'Satisfy',
		'Pinyon Script'  => 'Pinyon Script',
	];
}

/** Fonts served from Google Fonts (everything except Bestermind which is custom/local). */
function pontus_google_fonts_list(): array {
	return [
		'Montserrat', 'Inter', 'Lato', 'Open Sans', 'Raleway', 'Poppins',
		'Nunito', 'Roboto', 'DM Sans', 'Mulish', 'Josefin Sans', 'Quicksand',
		'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Lora',
		'Merriweather', 'Dancing Script', 'Pacifico', 'Sacramento',
		'Great Vibes', 'Allura', 'Satisfy', 'Pinyon Script',
	];
}

/**
 * Defines each front-end section.
 *
 * Keys:
 *  label       – Customizer section title
 *  priority    – order inside the panel
 *  bg_sel      – CSS selector to receive background-color override
 *  heading_sel – CSS selector for heading elements
 *  body_sel    – CSS selector for body/paragraph elements
 *  has_script  – whether a script/accent text colour control is shown
 *  script_sel  – CSS selector for script text (only when has_script = true)
 */
function pontus_get_sections_config(): array {
	return [
		'topbar' => [
			'label'       => __('Topbar', 'pontus-zenergija'),
			'priority'    => 10,
			'bg_sel'      => '.site-topbar',
			'heading_sel' => '.site-topbar__announcement',
			'body_sel'    => '.site-topbar',
			'has_script'  => false,
		],
		'header' => [
			'label'       => __('Header / Navigation', 'pontus-zenergija'),
			'priority'    => 20,
			'bg_sel'      => '.site-header',
			'heading_sel' => '.site-header__cta',
			'body_sel'    => '.site-nav a, .site-mobile-panel a',
			'has_script'  => false,
		],
		'about' => [
			'label'       => __('About Brand', 'pontus-zenergija'),
			'priority'    => 30,
			'bg_sel'      => '.home-about-brand',
			'heading_sel' => '.home-about-brand__title',
			'body_sel'    => '.home-about-brand__text p',
			'has_script'  => true,
			'script_sel'  => '.home-about-brand__script',
		],
		'newsletter' => [
			'label'       => __('Newsletter', 'pontus-zenergija'),
			'priority'    => 40,
			'bg_sel'      => '.home-newsletter',
			'heading_sel' => '.home-newsletter__title',
			'body_sel'    => '.home-newsletter__text p',
			'has_script'  => true,
			'script_sel'  => '.home-newsletter__script',
		],
		'highlights' => [
			'label'       => __('Highlights', 'pontus-zenergija'),
			'priority'    => 50,
			'bg_sel'      => '.home-highlights',
			'heading_sel' => '.home-highlights__title',
			'body_sel'    => '.home-highlights__subtitle, .home-highlights__text p, .home-highlights__item-title',
			'has_script'  => false,
		],
		'values' => [
			'label'       => __('Values', 'pontus-zenergija'),
			'priority'    => 60,
			'bg_sel'      => '.home-values',
			'heading_sel' => '.home-values__card-title',
			'body_sel'    => '.home-values__text p, .home-values__card-text p',
			'has_script'  => true,
			'script_sel'  => '.home-values__title',
		],
		'testimonials' => [
			'label'       => __('Testimonials', 'pontus-zenergija'),
			'priority'    => 70,
			'bg_sel'      => '.home-testimonials',
			'heading_sel' => '.home-testimonials__card-title',
			'body_sel'    => '.home-testimonials__text p, .home-testimonials__author',
			'has_script'  => true,
			'script_sel'  => '.home-testimonials__title',
		],
		'blog' => [
			'label'       => __('Blog', 'pontus-zenergija'),
			'priority'    => 80,
			'bg_sel'      => '.home-blog-section',
			'heading_sel' => '.home-blog-section__title',
			'body_sel'    => '.post-card__title, .post-card__excerpt',
			'has_script'  => false,
		],
		'instagram' => [
			'label'       => __('Instagram', 'pontus-zenergija'),
			'priority'    => 90,
			'bg_sel'      => '.home-instagram',
			'heading_sel' => '.home-instagram__title',
			'body_sel'    => '.home-instagram__script',
			'has_script'  => false,
		],
		'footer' => [
			'label'       => __('Footer', 'pontus-zenergija'),
			'priority'    => 100,
			'bg_sel'      => '.site-footer',
			'heading_sel' => '.site-footer__heading',
			'body_sel'    => '.site-footer__text, .site-footer__info-text',
			'has_script'  => false,
		],
	];
}

// ---------------------------------------------------------------------------
// Customizer registration
// ---------------------------------------------------------------------------

function pontus_typography_customize_register(WP_Customize_Manager $wp_customize): void {

	// -----------------------------------------------------------------------
	// Panel: Typography – global font families only
	// -----------------------------------------------------------------------
	$wp_customize->add_panel('pontus_typography_panel', [
		'title'       => __('Typography', 'pontus-zenergija'),
		'priority'    => 25,
		'description' => __('Choose the font families used across the site.', 'pontus-zenergija'),
	]);

	$wp_customize->add_section('pontus_global_fonts', [
		'title'       => __('Font Families', 'pontus-zenergija'),
		'panel'       => 'pontus_typography_panel',
		'priority'    => 10,
		'description' => __('Select font families for body text, headings, and script/accent elements.', 'pontus-zenergija'),
	]);

	$font_fields = [
		'body_font' => [
			'label'   => __('Body font', 'pontus-zenergija'),
			'default' => 'Montserrat',
			'choices' => pontus_get_font_choices(),
		],
		'heading_font' => [
			'label'   => __('Heading font', 'pontus-zenergija'),
			'default' => 'Montserrat',
			'choices' => pontus_get_font_choices(),
		],
		'script_font' => [
			'label'   => __('Script / Accent font', 'pontus-zenergija'),
			'default' => 'Bestermind',
			'choices' => pontus_get_script_font_choices(),
		],
	];

	foreach ($font_fields as $id => $cfg) {
		$wp_customize->add_setting('pontus_' . $id, [
			'default'           => $cfg['default'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		]);
		$wp_customize->add_control('pontus_' . $id, [
			'type'    => 'select',
			'label'   => $cfg['label'],
			'section' => 'pontus_global_fonts',
			'choices' => $cfg['choices'],
		]);
	}

	// -----------------------------------------------------------------------
	// Panel: Section Styles – background colour + text colours per section
	// -----------------------------------------------------------------------
	$wp_customize->add_panel('pontus_sections_panel', [
		'title'       => __('Section Styles', 'pontus-zenergija'),
		'priority'    => 35,
		'description' => __('Override background and text colours for each section individually.', 'pontus-zenergija'),
	]);

	foreach (pontus_get_sections_config() as $key => $cfg) {
		$section_id = 'pontus_typo_' . $key;

		$wp_customize->add_section($section_id, [
			'title'    => $cfg['label'],
			'panel'    => 'pontus_sections_panel',
			'priority' => $cfg['priority'],
		]);

		// Background colour
		$wp_customize->add_setting('pontus_typo_' . $key . '_bg_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		]);
		$wp_customize->add_control(
			new WP_Customize_Color_Control($wp_customize, 'pontus_typo_' . $key . '_bg_color', [
				'label'   => __('Background color', 'pontus-zenergija'),
				'section' => $section_id,
			])
		);

		// Heading text colour
		$wp_customize->add_setting('pontus_typo_' . $key . '_heading_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		]);
		$wp_customize->add_control(
			new WP_Customize_Color_Control($wp_customize, 'pontus_typo_' . $key . '_heading_color', [
				'label'   => __('Heading color', 'pontus-zenergija'),
				'section' => $section_id,
			])
		);

		// Body text colour
		$wp_customize->add_setting('pontus_typo_' . $key . '_body_color', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		]);
		$wp_customize->add_control(
			new WP_Customize_Color_Control($wp_customize, 'pontus_typo_' . $key . '_body_color', [
				'label'   => __('Body text color', 'pontus-zenergija'),
				'section' => $section_id,
			])
		);

		// Script / Accent text colour (only for sections that have it)
		if (!empty($cfg['has_script'])) {
			$wp_customize->add_setting('pontus_typo_' . $key . '_script_color', [
				'default'           => '',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]);
			$wp_customize->add_control(
				new WP_Customize_Color_Control($wp_customize, 'pontus_typo_' . $key . '_script_color', [
					'label'   => __('Script / Accent text color', 'pontus-zenergija'),
					'section' => $section_id,
				])
			);
		}
	}
}
add_action('customize_register', 'pontus_typography_customize_register');

// ---------------------------------------------------------------------------
// Google Fonts enqueue
// ---------------------------------------------------------------------------

/** Builds a Google Fonts URL for the given font names with common weight variants. */
function pontus_build_google_fonts_url(array $font_names): string {
	$google_fonts = pontus_google_fonts_list();
	$families     = [];

	foreach (array_unique($font_names) as $name) {
		if (in_array($name, $google_fonts, true)) {
			$slug       = str_replace(' ', '+', $name);
			$families[] = 'family=' . $slug . ':ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800';
		}
	}

	if (empty($families)) {
		return '';
	}

	return 'https://fonts.googleapis.com/css2?' . implode('&', $families) . '&display=swap';
}

function pontus_enqueue_google_fonts(): void {
	$body_font    = get_theme_mod('pontus_body_font', 'Montserrat');
	$heading_font = get_theme_mod('pontus_heading_font', 'Montserrat');
	$script_font  = get_theme_mod('pontus_script_font', 'Bestermind');

	$url = pontus_build_google_fonts_url([$body_font, $heading_font, $script_font]);
	if (!$url) {
		return;
	}

	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="stylesheet" href="' . esc_url($url) . '">' . "\n";
}
add_action('wp_head', 'pontus_enqueue_google_fonts', 5);

// ---------------------------------------------------------------------------
// CSS output
// ---------------------------------------------------------------------------

/**
 * Builds a CSS rule block, skipping any property whose value is empty.
 *
 * @param string               $selectors Comma-separated CSS selector string.
 * @param array<string,string> $props     property → value pairs.
 */
function pontus_build_css_rule(string $selectors, array $props): string {
	$declarations = [];
	foreach ($props as $property => $value) {
		if ($value !== '' && $value !== null) {
			$declarations[] = "\t\t\t" . $property . ': ' . esc_attr((string) $value) . ';';
		}
	}

	if (empty($declarations)) {
		return '';
	}

	return $selectors . " {\n" . implode("\n", $declarations) . "\n\t\t\t}\n";
}

function pontus_print_typography_css(): void {
	// --- Global font-family variables ---------------------------------------
	$body_font    = get_theme_mod('pontus_body_font', 'Montserrat');
	$heading_font = get_theme_mod('pontus_heading_font', 'Montserrat');
	$script_font  = get_theme_mod('pontus_script_font', 'Bestermind');

	$root_vars = [
		'--ff-body: "' . esc_attr($body_font) . '", sans-serif;',
		'--ff-heading: "' . esc_attr($heading_font) . '", sans-serif;',
		'--ff-script: "' . esc_attr($script_font) . '", cursive;',
	];

	// --- Per-section colour overrides ---------------------------------------
	$section_css = '';

	foreach (pontus_get_sections_config() as $key => $cfg) {
		$prefix = 'pontus_typo_' . $key . '_';

		$bg_color      = get_theme_mod($prefix . 'bg_color', '');
		$heading_color = get_theme_mod($prefix . 'heading_color', '');
		$body_color    = get_theme_mod($prefix . 'body_color', '');

		// Background
		if ($bg_color !== '' && $cfg['bg_sel'] !== '') {
			$section_css .= pontus_build_css_rule($cfg['bg_sel'], ['background-color' => $bg_color]);
		}

		// Heading colour
		if ($heading_color !== '' && $cfg['heading_sel'] !== '') {
			$section_css .= pontus_build_css_rule($cfg['heading_sel'], ['color' => $heading_color]);
		}

		// Body text colour
		if ($body_color !== '' && $cfg['body_sel'] !== '') {
			$section_css .= pontus_build_css_rule($cfg['body_sel'], ['color' => $body_color]);
		}

		// Script / Accent colour
		if (!empty($cfg['has_script']) && !empty($cfg['script_sel'])) {
			$script_color = get_theme_mod($prefix . 'script_color', '');
			if ($script_color !== '') {
				$section_css .= pontus_build_css_rule($cfg['script_sel'], ['color' => $script_color]);
			}
		}
	}

	// --- Output -------------------------------------------------------------
	echo "\n\t<style id=\"pontus-typography-vars\">\n";
	echo "\t\t:root {\n";
	foreach ($root_vars as $var) {
		echo "\t\t\t" . $var . "\n";
	}
	echo "\t\t}\n";

	if ($section_css !== '') {
		echo $section_css;
	}

	echo "\t</style>\n";
}
add_action('wp_head', 'pontus_print_typography_css', 21);
