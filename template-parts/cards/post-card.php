<?php
if (!defined('ABSPATH')) {
	exit;
}

$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();

if (!$post_id) {
	return;
}

$permalink      = get_permalink($post_id);
$title          = get_the_title($post_id);
$image_html     = get_the_post_thumbnail($post_id, 'large', [
	'class'   => 'post-card__image',
	'loading' => 'lazy',
]);
$category       = pontus_get_post_primary_category($post_id);
$category_name  = $category ? $category->name : '';
$category_link  = $category ? get_term_link($category) : '';
$author_name    = pontus_get_post_author_name($post_id);
$author_bio     = pontus_get_post_author_short_bio($post_id);
$author_link    = pontus_get_post_author_permalink($post_id);
$reading_time   = pontus_get_post_reading_time_label($post_id);
$excerpt        = pontus_get_post_card_excerpt($post_id, 22);
$post_date      = get_the_date('d.m.Y.', $post_id);
?>

<article class="post-card">
	<?php if (!empty($image_html)) : ?>
		<div class="post-card__media">
			<a class="post-card__media-link" href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr($title); ?>">
				<?php echo $image_html; ?>
			</a>

			<?php if (!empty($category_name)) : ?>
				<div class="post-card__badge-wrap">
					<?php if (!is_wp_error($category_link) && !empty($category_link)) : ?>
						<a class="post-card__badge" href="<?php echo esc_url($category_link); ?>">
							<?php echo esc_html($category_name); ?>
						</a>
					<?php else : ?>
						<span class="post-card__badge"><?php echo esc_html($category_name); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="post-card__body">
		<div class="post-card__meta">
			<div class="post-card__meta-left">
				<?php if (!empty($author_name)) : ?>
					<div class="post-card__author">
						<?php if (!empty($author_link)) : ?>
							<a class="post-card__author-name" href="<?php echo esc_url($author_link); ?>">
								<?php echo esc_html($author_name); ?>
							</a>
						<?php else : ?>
							<span class="post-card__author-name"><?php echo esc_html($author_name); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($post_date)) : ?>
					<div class="post-card__date"><?php echo esc_html($post_date); ?></div>
				<?php endif; ?>
			</div>

			<?php if (!empty($reading_time)) : ?>
				<div class="post-card__reading-time"><?php echo esc_html($reading_time); ?></div>
			<?php endif; ?>
		</div>

		<h3 class="post-card__title">
			<a href="<?php echo esc_url($permalink); ?>">
				<?php echo esc_html($title); ?>
			</a>
		</h3>

		<?php if (!empty($excerpt)) : ?>
			<div class="post-card__excerpt">
				<?php echo esc_html($excerpt); ?>
			</div>
		<?php endif; ?>

		<div class="post-card__footer">
			<a class="post-card__cta" href="<?php echo esc_url($permalink); ?>">
				<?php esc_html_e('Pročitaj više', 'pontus-zenergija'); ?>
			</a>
		</div>
	</div>
</article>