<?php
if (!defined('ABSPATH')) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">
<?php wp_body_open(); ?>

<div class="site-shell">
	<?php get_template_part('template-parts/header/topbar'); ?>

	<header class="site-header" aria-label="<?php esc_attr_e('Site header', 'pontus-zenergija'); ?>">
		<div class="site-header__inner pontus-container">
			<div class="site-header__branding">
				<a class="site-header__brand-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<span class="site-header__brand-fallback" aria-hidden="true">
							<?php get_template_part('template-parts/global/brand-logo'); ?>
						</span>
						<span class="screen-reader-text"><?php bloginfo('name'); ?></span>
					<?php endif; ?>
				</a>
			</div>

			<div class="site-header__desktop">
				<?php get_template_part('template-parts/header/navigation', null, ['context' => 'desktop']); ?>

				<?php get_template_part('template-parts/header/language-switcher'); ?>

				<div class="site-header__actions">
					

					<a class="site-header__cta" href="<?php echo esc_url(home_url('/savjetovaliste/')); ?>">
						<?php esc_html_e('Savjetovalište', 'pontus-zenergija'); ?>
					</a>
				</div>
			</div>

			<div class="site-header__mobile-actions">
				

				<button
					class="site-header__menu-toggle"
					type="button"
					aria-label="<?php esc_attr_e('Open menu', 'pontus-zenergija'); ?>"
					aria-expanded="false"
					aria-controls="site-mobile-panel"
				>
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</div>

		<div class="site-mobile-panel" id="site-mobile-panel" hidden>
			<div class="site-mobile-panel__inner pontus-container">
				<?php get_template_part('template-parts/header/navigation', null, ['context' => 'mobile']); ?>

				<?php if (function_exists('pll_the_languages')) : ?>
					<div class="site-mobile-panel__lang-switcher" aria-label="<?php esc_attr_e('Language switcher', 'pontus-zenergija'); ?>">
						<?php
						pll_the_languages([
							'dropdown'         => 0,
							'show_names'       => 1,
							'show_flags'       => 0,
							'hide_current'     => 0,
							'display_names_as' => 'slug',
							'echo'             => 1,
						]);
						?>
					</div>
				<?php endif; ?>

				<a class="site-mobile-panel__cta" href="<?php echo esc_url(home_url('/savjetovaliste/')); ?>">
					<?php esc_html_e('Savjetovalište', 'pontus-zenergija'); ?>
				</a>
			</div>
		</div>
	</header>