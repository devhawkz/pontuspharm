<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled  = get_field('values_section_enabled');
$section_title    = get_field('values_section_title') ?: __('Naše vrijednosti', 'pontus-zenergija');
$section_text     = get_field('values_section_text') ?: '';

$item_1_icon      = get_field('values_item_1_icon');
$item_1_title     = get_field('values_item_1_title') ?: '';
$item_1_text      = get_field('values_item_1_text') ?: '';

$item_2_icon      = get_field('values_item_2_icon');
$item_2_title     = get_field('values_item_2_title') ?: '';
$item_2_text      = get_field('values_item_2_text') ?: '';

$item_3_icon      = get_field('values_item_3_icon');
$item_3_title     = get_field('values_item_3_title') ?: '';
$item_3_text      = get_field('values_item_3_text') ?: '';

if (!$section_enabled) {
	return;
}

$items = [
	[
		'icon'  => $item_1_icon,
		'title' => $item_1_title,
		'text'  => $item_1_text,
	],
	[
		'icon'  => $item_2_icon,
		'title' => $item_2_title,
		'text'  => $item_2_text,
	],
	[
		'icon'  => $item_3_icon,
		'title' => $item_3_title,
		'text'  => $item_3_text,
	],
];
?>

<section class="home-values" aria-labelledby="home-values-title">
	<div class="home-values__inner pontus-container">
		<header class="home-values__header">
			<h2 class="home-values__title" id="home-values-title">
				<?php echo esc_html($section_title); ?>
			</h2>

			<?php if (!empty($section_text)) : ?>
				<div class="home-values__text">
					<p><?php echo esc_html($section_text); ?></p>
				</div>
			<?php endif; ?>
		</header>

		<div class="home-values__cards">
			<?php foreach ($items as $item) : ?>
				<?php
				if (empty($item['title']) || empty($item['text'])) {
					continue;
				}

				$icon_url = '';
				$icon_alt = '';

				if (is_array($item['icon']) && !empty($item['icon']['url'])) {
					$icon_url = $item['icon']['url'];
					$icon_alt = !empty($item['icon']['alt']) ? $item['icon']['alt'] : $item['title'];
				}
				?>
				<article class="home-values__card">
					<?php if (!empty($icon_url)) : ?>
						<div class="home-values__card-icon" aria-hidden="true">
							<img
								src="<?php echo esc_url($icon_url); ?>"
								alt=""
								loading="lazy"
							>
						</div>
					<?php endif; ?>

					<h3 class="home-values__card-title">
						<?php echo esc_html($item['title']); ?>
					</h3>

					<div class="home-values__card-text">
						<p><?php echo esc_html($item['text']); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>