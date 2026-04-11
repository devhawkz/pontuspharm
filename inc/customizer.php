<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Registers theme options in Customizer.
 */
function pontus_customize_register(WP_Customize_Manager $wp_customize): void
{
	$wp_customize->add_section('pontus_theme_colors', [
		'title'       => __('Theme Colors', 'pontus-zenergija'),
		'priority'    => 30,
		'description' => __('Manage the main theme palette.', 'pontus-zenergija'),
	]);

	$colors = [
		'primary' => [
			'label'   => __('Primary color', 'pontus-zenergija'),
			'default' => '#477A5D',
		],
		'secondary' => [
			'label'   => __('Secondary color', 'pontus-zenergija'),
			'default' => '#35552B',
		],
		'accent_blue' => [
			'label'   => __('Accent blue', 'pontus-zenergija'),
			'default' => '#5596B1',
		],
		'accent_ochre' => [
			'label'   => __('Accent ochre', 'pontus-zenergija'),
			'default' => '#E2B263',
		],
		'neutral_warm' => [
			'label'   => __('Warm neutral', 'pontus-zenergija'),
			'default' => '#D0BFA2',
		],
		'bg' => [
			'label'   => __('Background color', 'pontus-zenergija'),
			'default' => '#F7F4EE',
		],
		'surface' => [
			'label'   => __('Surface color', 'pontus-zenergija'),
			'default' => '#FFFFFF',
		],
		'text' => [
			'label'   => __('Text color', 'pontus-zenergija'),
			'default' => '#1F2A1F',
		],
		'topbar_bg' => [
			'label'   => __('Topbar background', 'pontus-zenergija'),
			'default' => '#6E9A82',
		],
		'cta_bg' => [
			'label'   => __('CTA button background', 'pontus-zenergija'),
			'default' => '#44738D',
		],
	];

	foreach ($colors as $key => $config) {
		$setting_id = 'pontus_color_' . $key;

		$wp_customize->add_setting($setting_id, [
			'default'           => $config['default'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		]);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				[
					'label'    => $config['label'],
					'section'  => 'pontus_theme_colors',
					'settings' => $setting_id,
				]
			)
		);
	}
}
add_action('customize_register', 'pontus_customize_register');

/**
 * Returns sanitized theme color from Customizer.
 */
function pontus_get_theme_color(string $key, string $default): string
{
	$value = get_theme_mod('pontus_color_' . $key, $default);

	if (!is_string($value) || $value === '') {
		return $default;
	}

	$sanitized = sanitize_hex_color($value);

	return $sanitized ?: $default;
}

/**
 * Prints CSS variables to the frontend head.
 */
function pontus_print_theme_color_variables(): void
{
	$primary      = pontus_get_theme_color('primary', '#477A5D');
	$secondary    = pontus_get_theme_color('secondary', '#35552B');
	$accent_blue  = pontus_get_theme_color('accent_blue', '#5596B1');
	$accent_ochre = pontus_get_theme_color('accent_ochre', '#E2B263');
	$neutral_warm = pontus_get_theme_color('neutral_warm', '#D0BFA2');
	$bg           = pontus_get_theme_color('bg', '#F7F4EE');
	$surface      = pontus_get_theme_color('surface', '#FFFFFF');
	$text         = pontus_get_theme_color('text', '#1F2A1F');
	$topbar_bg    = pontus_get_theme_color('topbar_bg', '#6E9A82');
	$cta_bg       = pontus_get_theme_color('cta_bg', '#44738D');

	?>
	<style id="pontus-theme-color-vars">
		:root {
			--c-primary: <?php echo esc_html($primary); ?>;
			--c-secondary: <?php echo esc_html($secondary); ?>;
			--c-accent-blue: <?php echo esc_html($accent_blue); ?>;
			--c-accent-ochre: <?php echo esc_html($accent_ochre); ?>;
			--c-neutral-warm: <?php echo esc_html($neutral_warm); ?>;
			--c-bg: <?php echo esc_html($bg); ?>;
			--c-surface: <?php echo esc_html($surface); ?>;
			--c-text: <?php echo esc_html($text); ?>;
			--c-topbar-bg: <?php echo esc_html($topbar_bg); ?>;
			--c-cta-bg: <?php echo esc_html($cta_bg); ?>;
		}
	</style>
	<?php
}
add_action('wp_head', 'pontus_print_theme_color_variables', 20);