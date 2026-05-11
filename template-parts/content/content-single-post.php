<?php
if (!defined('ABSPATH')) {
	exit;
}

$post_id = get_the_ID();

if (!$post_id) {
	return;
}

$category      = pontus_get_post_primary_category($post_id);
$category_name = $category ? $category->name : '';
$category_link = $category ? get_term_link($category) : '';
$reading_time  = pontus_get_post_reading_time_label($post_id);

$author_id     = pontus_get_post_author_profile_id($post_id);
$author_name   = pontus_get_post_author_name($post_id);
$author_title  = pontus_get_post_author_title($post_id);
$author_bio    = $author_id ? pontus_get_author_profile_long_bio($author_id) : '';
$author_link   = pontus_get_post_author_permalink($post_id);

$author_panel_id = $author_id ? 'single-post-author-panel-' . $author_id : 'single-post-author-panel-0';

$thumb_html = '';

if ($author_id && has_post_thumbnail($author_id)) {
	$thumb_html = get_the_post_thumbnail($author_id, 'thumbnail', [
		'class'   => 'single-post-author__photo-img',
		'loading' => 'lazy',
		'decoding'=> 'async',
	]);
}

$initials = '';

if ($author_name !== '') {
	$parts = preg_split('/\s+/u', $author_name, -1, PREG_SPLIT_NO_EMPTY);

	if (is_array($parts)) {
		$slice = array_slice($parts, 0, 2);

		foreach ($slice as $part) {
			$initials .= function_exists('mb_substr')
				? mb_strtoupper(mb_substr($part, 0, 1))
				: strtoupper(substr($part, 0, 1));
		}
	}
}

if ($initials === '') {
	$initials = '?';
}

$single_post_lang = '';

if (function_exists('pll_current_language')) {
	$slug = pll_current_language('slug');
	$single_post_lang = is_string($slug) ? $slug : '';
}

if ($single_post_lang === '') {
	$single_post_lang = str_replace('_', '-', get_locale());
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> lang="<?php echo esc_attr($single_post_lang); ?>">
	<div class="single-post__inner pontus-container">
		<header class="single-post__header">
			<h1 class="single-post__title"><?php the_title(); ?></h1>

			<?php if ($author_id && $author_name !== '') : ?>
				<div class="single-post__meta" data-single-post-author>
					<div class="single-post__meta-row">
						<div class="single-post-author">
							<button
								type="button"
								class="single-post-author__toggle"
								aria-expanded="false"
								aria-controls="<?php echo esc_attr($author_panel_id); ?>"
							>
								<span class="single-post-author__photo" aria-hidden="true">
									<?php if ($thumb_html) : ?>
										<?php echo $thumb_html; ?>
									<?php else : ?>
										<span class="single-post-author__photo-placeholder"><?php echo esc_html($initials); ?></span>
									<?php endif; ?>
								</span>
								<span class="single-post-author__name-wrap">
									<span class="single-post-author__label"><?php esc_html_e('Autor', 'pontus-zenergija'); ?></span>
									<span class="single-post-author__name"><?php echo esc_html($author_name); ?></span>
								</span>
							</button>
						</div>

						<?php if (!empty($reading_time)) : ?>
							<span class="single-post__reading"><?php echo esc_html($reading_time); ?></span>
						<?php endif; ?>

						<?php if (!empty($category_name)) : ?>
							<?php if (!is_wp_error($category_link) && !empty($category_link)) : ?>
								<a class="single-post__category" href="<?php echo esc_url($category_link); ?>">
									<?php echo esc_html($category_name); ?>
								</a>
							<?php else : ?>
								<span class="single-post__category"><?php echo esc_html($category_name); ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<div id="<?php echo esc_attr($author_panel_id); ?>" class="single-post-author__panel" hidden>
						<?php if (!empty($author_title)) : ?>
							<p class="single-post-author__role"><?php echo esc_html($author_title); ?></p>
						<?php endif; ?>

						<?php if (!empty($author_bio)) : ?>
							<p class="single-post-author__bio"><?php echo esc_html($author_bio); ?></p>
						<?php endif; ?>

						<?php if (!empty($author_link)) : ?>
							<p class="single-post-author__more">
								<a class="single-post-author__link" href="<?php echo esc_url($author_link); ?>">
									<?php esc_html_e('Pogledaj profil autora', 'pontus-zenergija'); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if (empty($author_title) && empty($author_bio) && empty($author_link)) : ?>
							<p class="single-post-author__empty"><?php esc_html_e('Nema dodatnih podataka o autoru.', 'pontus-zenergija'); ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php else : ?>
				<div class="single-post__meta-row">
					<?php if (!empty($reading_time)) : ?>
						<span class="single-post__reading"><?php echo esc_html($reading_time); ?></span>
					<?php endif; ?>

					<?php if (!empty($category_name)) : ?>
						<?php if (!is_wp_error($category_link) && !empty($category_link)) : ?>
							<a class="single-post__category" href="<?php echo esc_url($category_link); ?>">
								<?php echo esc_html($category_name); ?>
							</a>
						<?php else : ?>
							<span class="single-post__category"><?php echo esc_html($category_name); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</header>

		<?php if (has_post_thumbnail()) : ?>
			<figure class="single-post__featured">
				<?php
				the_post_thumbnail('large', [
					'class'   => 'single-post__featured-img',
					'loading' => 'eager',
				]);
				?>
			</figure>
		<?php endif; ?>

		<div class="single-post__content entry-content">
			<?php the_content(); ?>
		</div>

		<footer class="single-post__footer">
			<a class="single-post__back" href="<?php echo esc_url(pontus_get_blog_index_url()); ?>">
				<?php esc_html_e('Sve objave', 'pontus-zenergija'); ?>
			</a>
		</footer>
	</div>
</article>
