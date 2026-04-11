<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled = get_field('about_brand_section_enabled');
$section_title   = get_field('about_brand_section_title') ?: __('DOBRODOŠLI', 'pontus-zenergija');
$section_script  = get_field('about_brand_section_script_title') ?: __('u Probavnu ZENergiju', 'pontus-zenergija');
$section_text_1  = get_field('about_brand_section_text_1') ?: '';
$section_text_2  = get_field('about_brand_section_text_2') ?: '';
$button_label    = get_field('about_brand_section_button_label') ?: __('Saznajte više', 'pontus-zenergija');
$button_url      = get_field('about_brand_section_button_url') ?: '';

if (!$section_enabled) {
	return;
}
?>

<section class="home-about-brand" aria-labelledby="home-about-brand-title">
	<div class="home-about-brand__inner pontus-container">
		<div class="home-about-brand__media" aria-hidden="true">
			<div class="home-about-brand__shape home-about-brand__shape--back"></div>

			<div class="home-about-brand__logo-wrap">
				<div class="home-about-brand__logo">
					<?php get_template_part('template-parts/global/brand-logo'); ?>
				</div>
			</div>

			<div class="home-about-brand__shape home-about-brand__shape--accent"></div>
			<div class="home-about-brand__shape home-about-brand__shape--dot"></div>
			<div class="home-about-brand__shape home-about-brand__shape--outline"></div>
		</div>

		<div class="home-about-brand__content">
			<header class="home-about-brand__header">
				<h2 class="home-about-brand__title" id="home-about-brand-title">
					<?php echo esc_html($section_title); ?>
				</h2>

				<?php if (!empty($section_script)) : ?>
					<div class="home-about-brand__script">
						<?php echo esc_html($section_script); ?>
					</div>
				<?php endif; ?>
			</header>

			<?php if (!empty($section_text_1)) : ?>
				<div class="home-about-brand__text">
					<p><?php echo esc_html($section_text_1); ?></p>
				</div>
			<?php endif; ?>

			<?php if (!empty($section_text_2)) : ?>
				<div class="home-about-brand__text">
					<p><?php echo esc_html($section_text_2); ?></p>
				</div>
			<?php endif; ?>

			<?php if (!empty($button_label) && !empty($button_url)) : ?>
				<div class="home-about-brand__footer">
					<a class="home-about-brand__button" href="<?php echo esc_url($button_url); ?>">
						<?php echo esc_html($button_label); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>