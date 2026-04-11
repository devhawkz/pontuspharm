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
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/header/topbar'); ?>

<header class="site-header" aria-label="<?php esc_attr_e('Site header', 'pontus-zenergija'); ?>">
	<div class="site-header__inner pontus-container">
		<div class="site-header__branding">
			<a class="site-header__brand-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
				<?php if (has_custom_logo()) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="site-header__brand-fallback" aria-hidden="true">
						<svg class="site-header__brand-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 942 188" role="img" aria-hidden="true" focusable="false">
							<title>pontus-pharma-logo</title>
							<path d="M86.52276,107.77071H2.628v73.40747H13.11385V118.25729H86.52276a10.48694,10.48694,0,1,1,0,20.97388h-52.435V149.717h52.435a20.98519,20.98519,0,0,0,14.83841-35.81157,20.21705,20.21705,0,0,0-14.83841-6.13475" transform="translate(-2.62799)" />
							<path d="M235.7977,107.77045H204.338a36.69874,36.69874,0,0,0-36.70447,36.70373A36.69756,36.69756,0,0,0,204.338,181.17792h31.4597a36.69633,36.69633,0,0,0,36.70375-36.70375,36.69752,36.69752,0,0,0-36.70375-36.70373m18.53539,55.2398a25.26007,25.26007,0,0,1-18.53539,7.6811H204.338a26.21295,26.21295,0,0,1-18.53679-44.7518,25.25979,25.25979,0,0,1,18.53679-7.6818h31.4597a26.213,26.213,0,0,1,18.53539,44.7525" transform="translate(-2.62799)" />
							<polygon points="429.066 167.284 334.684 101.584 334.684 181.178 345.171 181.178 345.171 121.665 439.552 187.365 439.552 107.77 429.066 107.77 429.066 167.284" />
							<polygon points="497.82 118.257 545.011 118.257 545.011 181.178 555.497 181.178 555.497 118.257 602.688 118.257 602.688 107.771 497.82 107.771 497.82 118.257" />
							<path d="M758.064,144.47437a26.22492,26.22492,0,0,1-26.21717,26.21717H700.38708a26.22492,26.22492,0,0,1-26.21786-26.21717V107.77064H663.68268v36.70373a36.69993,36.69993,0,0,0,36.7044,36.70375h31.45978a36.69756,36.69756,0,0,0,36.7037-36.70375V107.77064H758.064Z" transform="translate(-2.62799)" />
							<path d="M856.106,118.25735H940V107.7708H856.106a20.98468,20.98468,0,0,0-14.83849,35.81226,20.213,20.213,0,0,0,14.83849,6.134h62.92157a10.48729,10.48729,0,1,1,0,20.97457H835.132v10.48658h83.89551a20.97351,20.97351,0,1,0,0-41.947H856.106a10.48694,10.48694,0,1,1,0-20.97388" transform="translate(-2.62799)" />
							<path d="M579.95131,24.99431C555.59114,24.99431,534.68287,14.522,525.67777,0c-8.9039,14.67876-29.93121,24.99431-54.45522,24.99431C446.86312,24.99431,425.95481,14.522,416.9497,0c-8.9039,14.67876-29.93121,24.99431-54.45522,24.99431C338.13505,24.99431,317.226,14.522,308.22168,0V33.44572H634.40583V0c-8.9032,14.67876-29.93055,24.99431-54.45452,24.99431" transform="translate(-2.62799)" />
						</svg>
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