<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled = get_field('instagram_section_enabled');
$section_title   = get_field('instagram_section_title') ?: __('Instagram', 'pontus-zenergija');
$section_script  = get_field('instagram_section_script_title') ?: '';
$profile_url     = get_field('instagram_section_profile_url') ?: '';

$items = [];

for ($i = 1; $i <= 6; $i++) {
	$image = get_field('instagram_post_image_' . $i);
	$url   = get_field('instagram_post_url_' . $i);
	$alt   = get_field('instagram_post_alt_' . $i);

	if (!empty($image)) {
		$items[] = [
			'image' => $image,
			'url'   => $url,
			'alt'   => $alt,
		];
	}
}

if (empty($section_enabled) || empty($items)) {
	return;
}
?>

<section class="home-instagram" aria-labelledby="home-instagram-title">
	<div class="home-instagram__inner pontus-container">
		<header class="home-instagram__header">
			<?php if (!empty($section_script)) : ?>
				<div class="home-instagram__script">
					<?php echo esc_html($section_script); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($section_title)) : ?>
				<h2 class="home-instagram__title" id="home-instagram-title">
					<?php echo esc_html($section_title); ?>
				</h2>
			<?php endif; ?>
		</header>

		<div
			class="home-instagram__grid"
			style="<?php echo esc_attr('--instagram-columns: ' . max(1, count($items))); ?>"
		>
			<?php foreach ($items as $item) : ?>
				<?php
				$image = $item['image'];
				$url   = $item['url'];
				$alt   = $item['alt'];

				$image_url = is_array($image) && !empty($image['sizes']['large'])
					? $image['sizes']['large']
					: (is_array($image) && !empty($image['url']) ? $image['url'] : '');

				$image_alt = !empty($alt)
					? $alt
					: (is_array($image) && !empty($image['alt']) ? $image['alt'] : $section_title);
				?>

				<div class="home-instagram__item">
					<?php if (!empty($url)) : ?>
						<a
							class="home-instagram__card"
							href="<?php echo esc_url($url); ?>"
							target="_blank"
							rel="noopener noreferrer"
							aria-label="<?php esc_attr_e('Open Instagram post', 'pontus-zenergija'); ?>"
						>
							<?php if (!empty($image_url)) : ?>
								<img
									class="home-instagram__image"
									src="<?php echo esc_url($image_url); ?>"
									alt="<?php echo esc_attr($image_alt); ?>"
									loading="lazy"
								>
							<?php endif; ?>
						</a>
					<?php else : ?>
						<div class="home-instagram__card">
							<?php if (!empty($image_url)) : ?>
								<img
									class="home-instagram__image"
									src="<?php echo esc_url($image_url); ?>"
									alt="<?php echo esc_attr($image_alt); ?>"
									loading="lazy"
								>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if (!empty($profile_url)) : ?>
			<div class="home-instagram__profile-wrap">
				<a
					class="home-instagram__profile-link"
					href="<?php echo esc_url($profile_url); ?>"
					target="_blank"
					rel="noopener noreferrer"
				>
					<?php esc_html_e('Zapratite nas na Instagramu', 'pontus-zenergija'); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>