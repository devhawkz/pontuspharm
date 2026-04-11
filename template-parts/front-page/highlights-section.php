<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled    = get_field('highlights_section_enabled');
$section_title      = get_field('highlights_section_title') ?: __('ISTAKNUTE TEME', 'pontus-zenergija');
$section_subtitle   = get_field('highlights_section_subtitle') ?: '';
$section_text       = get_field('highlights_section_text') ?: '';
$section_bg_image   = get_field('highlights_section_background_image');

$item_1_title       = get_field('highlights_item_1_title') ?: '';
$item_1_url         = get_field('highlights_item_1_url') ?: '';
$item_1_image       = get_field('highlights_item_1_image');

$item_2_title       = get_field('highlights_item_2_title') ?: '';
$item_2_url         = get_field('highlights_item_2_url') ?: '';
$item_2_image       = get_field('highlights_item_2_image');

$item_3_title       = get_field('highlights_item_3_title') ?: '';
$item_3_url         = get_field('highlights_item_3_url') ?: '';
$item_3_image       = get_field('highlights_item_3_image');

if (!$section_enabled) {
	return;
}

$bg_url = '';
if (is_array($section_bg_image) && !empty($section_bg_image['url'])) {
	$bg_url = $section_bg_image['url'];
}

$items = [
	[
		'title' => $item_1_title,
		'url'   => $item_1_url,
		'image' => $item_1_image,
	],
	[
		'title' => $item_2_title,
		'url'   => $item_2_url,
		'image' => $item_2_image,
	],
	[
		'title' => $item_3_title,
		'url'   => $item_3_url,
		'image' => $item_3_image,
	],
];
?>

<section
	class="home-highlights<?php echo !empty($bg_url) ? ' home-highlights--has-bg' : ''; ?>"
	aria-labelledby="home-highlights-title"
	<?php if (!empty($bg_url)) : ?>
		style="--highlights-bg-image: url('<?php echo esc_url($bg_url); ?>');"
	<?php endif; ?>
>
	<div class="home-highlights__inner pontus-container">
		<div class="home-highlights__panel">
			<header class="home-highlights__header">
				<h2 class="home-highlights__title" id="home-highlights-title">
					<?php echo esc_html($section_title); ?>
				</h2>

				<?php if (!empty($section_subtitle)) : ?>
					<div class="home-highlights__subtitle">
						<?php echo esc_html($section_subtitle); ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($section_text)) : ?>
					<div class="home-highlights__text">
						<p><?php echo esc_html($section_text); ?></p>
					</div>
				<?php endif; ?>
			</header>

			<div class="home-highlights__items">
				<?php foreach ($items as $item) : ?>
					<?php
					if (empty($item['title']) || empty($item['image'])) {
						continue;
					}

					$image_url = '';
					$image_alt = $item['title'];

					if (is_array($item['image']) && !empty($item['image']['sizes']['large'])) {
						$image_url = $item['image']['sizes']['large'];
						$image_alt = !empty($item['image']['alt']) ? $item['image']['alt'] : $item['title'];
					} elseif (is_array($item['image']) && !empty($item['image']['url'])) {
						$image_url = $item['image']['url'];
						$image_alt = !empty($item['image']['alt']) ? $item['image']['alt'] : $item['title'];
					}
					?>
					<div class="home-highlights__item">
						<?php if (!empty($item['url'])) : ?>
							<a class="home-highlights__item-link" href="<?php echo esc_url($item['url']); ?>">
								<span class="home-highlights__item-media">
									<img
										class="home-highlights__item-image"
										src="<?php echo esc_url($image_url); ?>"
										alt="<?php echo esc_attr($image_alt); ?>"
										loading="lazy"
									>
								</span>
								<span class="home-highlights__item-title"><?php echo esc_html($item['title']); ?></span>
							</a>
						<?php else : ?>
							<div class="home-highlights__item-link">
								<span class="home-highlights__item-media">
									<img
										class="home-highlights__item-image"
										src="<?php echo esc_url($image_url); ?>"
										alt="<?php echo esc_attr($image_alt); ?>"
										loading="lazy"
									>
								</span>
								<span class="home-highlights__item-title"><?php echo esc_html($item['title']); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>