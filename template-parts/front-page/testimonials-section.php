<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('get_field')) {
	return;
}

$section_enabled = get_field('testimonials_section_enabled');
$section_title   = get_field('testimonials_section_title');
$section_title   = is_string($section_title) && $section_title !== '' ? $section_title : __('Iskustva korisnika', 'pontus-zenergija');

$item_1_title  = get_field('testimonials_item_1_title');
$item_1_rating = get_field('testimonials_item_1_rating');
$item_1_text   = get_field('testimonials_item_1_text');
$item_1_author = get_field('testimonials_item_1_author');

$item_2_title  = get_field('testimonials_item_2_title');
$item_2_rating = get_field('testimonials_item_2_rating');
$item_2_text   = get_field('testimonials_item_2_text');
$item_2_author = get_field('testimonials_item_2_author');

if (!$section_enabled) {
	return;
}

$items = [
	[
		'title'  => is_string($item_1_title) ? trim($item_1_title) : '',
		'rating' => max(0, min(5, absint($item_1_rating))),
		'text'   => is_string($item_1_text) ? trim($item_1_text) : '',
		'author' => is_string($item_1_author) ? trim($item_1_author) : '',
	],
	[
		'title'  => is_string($item_2_title) ? trim($item_2_title) : '',
		'rating' => max(0, min(5, absint($item_2_rating))),
		'text'   => is_string($item_2_text) ? trim($item_2_text) : '',
		'author' => is_string($item_2_author) ? trim($item_2_author) : '',
	],
];
?>

<section class="home-testimonials" aria-labelledby="home-testimonials-title">
	<div class="home-testimonials__inner pontus-container">
		<header class="home-testimonials__header">
			<h2 class="home-testimonials__title" id="home-testimonials-title">
				<?php echo esc_html($section_title); ?>
			</h2>
		</header>

		<div class="home-testimonials__grid">
			<?php foreach ($items as $item) : ?>
				<?php
				if ($item['title'] === '' && $item['text'] === '' && $item['author'] === '') {
					continue;
				}
				?>
				<article class="home-testimonials__card">
					<?php if ($item['title'] !== '') : ?>
						<h3 class="home-testimonials__card-title">
							<?php echo esc_html($item['title']); ?>
						</h3>
					<?php endif; ?>

					<?php if (!empty($item['rating'])) : ?>
						<div class="home-testimonials__rating" aria-label="<?php echo esc_attr(sprintf(__('%d od 5 zvjezdica', 'pontus-zenergija'), $item['rating'])); ?>">
							<?php for ($i = 0; $i < $item['rating']; $i++) : ?>
								<span class="home-testimonials__star" aria-hidden="true">★</span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>

					<?php if ($item['text'] !== '') : ?>
						<div class="home-testimonials__text">
							<p><?php echo esc_html($item['text']); ?></p>
						</div>
					<?php endif; ?>

					<?php if ($item['author'] !== '') : ?>
						<footer class="home-testimonials__author">
							<?php echo esc_html($item['author']); ?>
						</footer>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>