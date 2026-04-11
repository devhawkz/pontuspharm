<?php
if (!defined('ABSPATH')) {
	exit;
}

$topbar_text = function_exists('pontus_get_translated_topbar_text')
	? pontus_get_translated_topbar_text('')
	: '';

$topbar_url = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('topbar_link_url', '')
	: '';

$instagram_url = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('header_instagram_url', '')
	: '';

$facebook_url = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('header_facebook_url', '')
	: '';

$youtube_url = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('header_youtube_url', '')
	: '';

$cta_label = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('header_cta_label', __('Savjetovalište', 'pontus-zenergija'))
	: __('Savjetovalište', 'pontus-zenergija');

$cta_url = function_exists('pontus_get_header_setting')
	? pontus_get_header_setting('header_cta_url', '#')
	: '#';

$search_url = home_url('/');

$has_topbar_socials = !empty($instagram_url) || !empty($facebook_url) || !empty($youtube_url);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-shell">
	<?php if (!empty($topbar_text) || $has_topbar_socials) : ?>
		<?php get_template_part('template-parts/header/topbar', null, [
			'topbar_text'   => $topbar_text,
			'topbar_url'    => $topbar_url,
			'instagram_url' => $instagram_url,
			'facebook_url'  => $facebook_url,
			'youtube_url'   => $youtube_url,
		]); ?>
	<?php endif; ?>

	<header class="site-header" role="banner">
		<div class="site-header__inner pontus-container">
			<div class="site-header__branding">
				<?php if (has_custom_logo()) : ?>
					<div class="site-header__brand-link">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<a class="site-header__brand-link site-header__brand-fallback" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php bloginfo('name'); ?>">
						<?php get_template_part('template-parts/global/brand-logo'); ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="site-header__desktop">
				<?php get_template_part('template-parts/header/navigation', null, ['context' => 'desktop']); ?>

				<?php get_template_part('template-parts/header/language-switcher', null, ['context' => 'desktop']); ?>

				<div class="site-header__actions">
					<?php if (!empty($cta_label) && !empty($cta_url)) : ?>
						<a class="site-header__cta" href="<?php echo esc_url($cta_url); ?>">
							<?php echo esc_html($cta_label); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="site-header__mobile-actions">
				<button
					class="site-header__menu-toggle"
					type="button"
					aria-expanded="false"
					aria-controls="site-mobile-panel"
					aria-label="<?php esc_attr_e('Otvori izbornik', 'pontus-zenergija'); ?>"
				>
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</div>

		<div id="site-mobile-panel" class="site-mobile-panel" hidden>
			<div class="site-mobile-panel__inner pontus-container">
				<?php get_template_part('template-parts/header/navigation', null, ['context' => 'mobile']); ?>

				<?php get_template_part('template-parts/header/language-switcher', null, ['context' => 'mobile']); ?>

				<?php if (!empty($cta_label) && !empty($cta_url)) : ?>
					<a class="site-mobile-panel__cta" href="<?php echo esc_url($cta_url); ?>">
						<?php echo esc_html($cta_label); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<main id="primary" class="site-main">