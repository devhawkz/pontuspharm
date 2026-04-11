<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled     = get_field('newsletter_section_enabled');
$section_title       = get_field('newsletter_section_title') ?: __('GET THE NEWS', 'pontus-zenergija');
$section_script      = get_field('newsletter_section_script_title') ?: __('workshops and retreats', 'pontus-zenergija');
$section_text        = get_field('newsletter_section_text') ?: __('Sign up to be kept up to date with meditation classes and workshops', 'pontus-zenergija');
$section_image       = get_field('newsletter_section_image');
$section_shortcode   = get_field('newsletter_section_shortcode');
$privacy_text        = get_field('newsletter_section_privacy_text') ?: '';
$privacy_url         = get_field('newsletter_section_privacy_url') ?: '';

if (!$section_enabled || empty($section_shortcode)) {
	return;
}

$image_url = '';
$image_alt = '';

if (is_array($section_image) && !empty($section_image['url'])) {
	$image_url = $section_image['url'];
	$image_alt = !empty($section_image['alt']) ? $section_image['alt'] : $section_title;
}
?>

<section class="home-newsletter" aria-labelledby="home-newsletter-title">
	<div class="home-newsletter__inner pontus-container">
		<?php if (!empty($image_url)) : ?>
			<div class="home-newsletter__media" aria-hidden="true">
				<div class="home-newsletter__media-stack">
					<div class="home-newsletter__media-back"></div>
					<div class="home-newsletter__media-front">
						<img
							class="home-newsletter__image"
							src="<?php echo esc_url($image_url); ?>"
							alt="<?php echo esc_attr($image_alt); ?>"
							loading="lazy"
						>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="home-newsletter__content">
			<header class="home-newsletter__header">
				<h2 class="home-newsletter__title" id="home-newsletter-title">
					<?php echo esc_html($section_title); ?>
				</h2>

				<?php if (!empty($section_script)) : ?>
					<div class="home-newsletter__script">
						<?php echo esc_html($section_script); ?>
					</div>
				<?php endif; ?>
			</header>

			<?php if (!empty($section_text)) : ?>
				<div class="home-newsletter__text">
					<p><?php echo esc_html($section_text); ?></p>
				</div>
			<?php endif; ?>

			<div class="home-newsletter__form-wrap">
				<?php echo do_shortcode(wp_kses_post($section_shortcode)); ?>
			</div>
		</div>
	</div>
</section>