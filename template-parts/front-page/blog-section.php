<?php
if (!defined('ABSPATH')) {
	exit;
}

$section_enabled = get_field('home_blog_section_enabled');
$section_title   = get_field('home_blog_section_title') ?: __('Blog', 'pontus-zenergija');
$cta_label       = get_field('home_blog_section_button_label') ?: __('Svi članci', 'pontus-zenergija');
$cta_url         = get_field('home_blog_section_button_url') ?: home_url('/blog/');
$selected_posts  = get_field('home_blog_section_posts');

if (!$section_enabled) {
	return;
}

$post_ids = [];

if (!empty($selected_posts) && is_array($selected_posts)) {
	foreach ($selected_posts as $item) {
		if ($item instanceof WP_Post) {
			$post_ids[] = (int) $item->ID;
		} elseif (is_numeric($item)) {
			$post_ids[] = (int) $item;
		}
	}
}

if (!empty($post_ids)) {
	$query = new WP_Query([
		'post_type'           => 'post',
		'post__in'            => $post_ids,
		'orderby'             => 'post__in',
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	]);
} else {
	$query = new WP_Query([
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	]);
}

if (!$query->have_posts()) {
	wp_reset_postdata();
	return;
}
?>

<section class="home-blog-section" aria-labelledby="home-blog-section-title">
	<div class="home-blog-section__inner pontus-container">
		<header class="home-blog-section__header">
			<h2 class="home-blog-section__title" id="home-blog-section-title">
				<?php echo esc_html($section_title); ?>
			</h2>
		</header>

		<div class="home-blog-section__cards">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="home-blog-section__card-item">
					<?php get_template_part('template-parts/cards/post-card', null, ['post_id' => get_the_ID()]); ?>
				</div>
			<?php endwhile; ?>
		</div>

		<?php if (!empty($cta_label) && !empty($cta_url)) : ?>
			<div class="home-blog-section__footer">
				<a class="home-blog-section__cta" href="<?php echo esc_url($cta_url); ?>">
					<?php echo esc_html($cta_label); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php wp_reset_postdata(); ?>