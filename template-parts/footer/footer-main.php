<?php
if (!defined('ABSPATH')) {
	exit;
}

$footer_brand_name        = pontus_get_translated_footer_setting('footer_brand_name', get_bloginfo('name'));
$footer_about_title       = pontus_get_translated_footer_setting('footer_about_title', __('O portalu', 'pontus-zenergija'));
$footer_about_text        = pontus_get_translated_footer_setting('footer_about_text', '');
$footer_info_title        = pontus_get_translated_footer_setting('footer_info_title', __('Informacije', 'pontus-zenergija'));
$footer_address           = pontus_get_translated_footer_setting('footer_address', '');
$footer_phone             = pontus_get_footer_setting('footer_phone', '');
$footer_email             = pontus_get_footer_setting('footer_email', '');
$footer_support_title     = pontus_get_translated_footer_setting('footer_support_title', __('Podrška i sadržaj', 'pontus-zenergija'));
$footer_support_text      = pontus_get_translated_footer_setting('footer_support_text', '');
$footer_instagram_url     = pontus_get_footer_setting('footer_instagram_url', '');
$footer_facebook_url      = pontus_get_footer_setting('footer_facebook_url', '');
$footer_youtube_url       = pontus_get_footer_setting('footer_youtube_url', '');
$footer_back_to_top_label = pontus_get_translated_footer_setting('footer_back_to_top_label', __('Na vrh', 'pontus-zenergija'));
?>

<footer class="site-footer" aria-label="<?php esc_attr_e('Site footer', 'pontus-zenergija'); ?>">
	<div class="site-footer__main">
		<div class="site-footer__inner pontus-container">
			<div class="site-footer__columns">
				<div class="site-footer__col site-footer__col--brand">
					<div class="site-footer__brand">
						<a
							class="site-footer__brand-link"
							href="<?php echo esc_url(home_url('/')); ?>"
							aria-label="<?php echo esc_attr($footer_brand_name); ?>"
						>
							<span class="site-footer__brand-fallback" aria-hidden="true">
								<?php get_template_part('template-parts/global/brand-logo'); ?>
							</span>
							<span class="screen-reader-text"><?php echo esc_html($footer_brand_name); ?></span>
						</a>
					</div>

					<div class="site-footer__socials" aria-label="<?php esc_attr_e('Social links', 'pontus-zenergija'); ?>">
						<?php if (!empty($footer_instagram_url)) : ?>
							<a
								class="site-footer__social-link"
								href="<?php echo esc_url($footer_instagram_url); ?>"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php esc_attr_e('Instagram', 'pontus-zenergija'); ?>"
							>
								<svg class="site-footer__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<rect x="3" y="3" width="18" height="18" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
									<circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
									<circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"></circle>
								</svg>
							</a>
						<?php endif; ?>

						<?php if (!empty($footer_facebook_url)) : ?>
							<a
								class="site-footer__social-link"
								href="<?php echo esc_url($footer_facebook_url); ?>"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php esc_attr_e('Facebook', 'pontus-zenergija'); ?>"
							>
								<svg class="site-footer__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M13.5 21V12.8H16.3L16.7 9.8H13.5V7.9C13.5 7 13.8 6.4 15.1 6.4H16.8V3.7C16.5 3.6 15.5 3.5 14.3 3.5C11.8 3.5 10.2 5 10.2 7.8V9.8H7.5V12.8H10.2V21Z" fill="currentColor"></path>
								</svg>
							</a>
						<?php endif; ?>

						<?php if (!empty($footer_youtube_url)) : ?>
							<a
								class="site-footer__social-link"
								href="<?php echo esc_url($footer_youtube_url); ?>"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php esc_attr_e('YouTube', 'pontus-zenergija'); ?>"
							>
								<svg class="site-footer__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M21 8.2C20.8 7.2 20 6.4 19 6.2C17.3 5.8 12 5.8 12 5.8C12 5.8 6.7 5.8 5 6.2C4 6.4 3.2 7.2 3 8.2C2.6 9.9 2.6 12 2.6 12C2.6 12 2.6 14.1 3 15.8C3.2 16.8 4 17.6 5 17.8C6.7 18.2 12 18.2 12 18.2C12 18.2 17.3 18.2 19 17.8C20 17.6 20.8 16.8 21 15.8C21.4 14.1 21.4 12 21.4 12C21.4 12 21.4 9.9 21 8.2Z" fill="none" stroke="currentColor" stroke-width="1.6"></path>
									<path d="M10.3 15.2L15.1 12L10.3 8.8V15.2Z" fill="currentColor"></path>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="site-footer__col site-footer__col--about">
					<?php if (!empty($footer_about_title)) : ?>
						<h2 class="site-footer__heading"><?php echo esc_html($footer_about_title); ?></h2>
					<?php endif; ?>

					<?php if (!empty($footer_about_text)) : ?>
						<div class="site-footer__text">
							<?php echo wp_kses_post(wpautop($footer_about_text)); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="site-footer__col site-footer__col--info">
					<?php if (!empty($footer_info_title)) : ?>
						<h2 class="site-footer__heading"><?php echo esc_html($footer_info_title); ?></h2>
					<?php endif; ?>

					<div class="site-footer__info-list">
						<?php if (!empty($footer_address)) : ?>
							<div class="site-footer__info-item">
								<span class="site-footer__info-icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" class="site-footer__info-svg">
										<path d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11Z" fill="currentColor"></path>
										<circle cx="12" cy="10" r="2.3" fill="white"></circle>
									</svg>
								</span>
								<div class="site-footer__info-text">
									<?php echo wp_kses_post(nl2br(esc_html($footer_address))); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($footer_phone)) : ?>
							<div class="site-footer__info-item">
								<span class="site-footer__info-icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" class="site-footer__info-svg">
										<path d="M6.6 3.9c.4-.4 1-.5 1.5-.2l2.2 1.3c.6.3.9 1 .7 1.6l-.6 2.1c-.1.4 0 .9.3 1.2l3.1 3.1c.3.3.8.4 1.2.3l2.1-.6c.6-.2 1.3.1 1.6.7l1.3 2.2c.3.5.2 1.1-.2 1.5l-1.5 1.5c-.8.8-2 1.1-3 .7-2.1-.8-4.1-2.1-5.8-3.9-1.8-1.8-3.1-3.7-3.9-5.8-.4-1-.1-2.2.7-3l1.5-1.5Z" fill="currentColor"></path>
									</svg>
								</span>
								<div class="site-footer__info-text">
									<a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $footer_phone)); ?>">
										<?php echo esc_html($footer_phone); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($footer_email)) : ?>
							<div class="site-footer__info-item">
								<span class="site-footer__info-icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" class="site-footer__info-svg">
										<path d="M3 6.5A1.5 1.5 0 0 1 4.5 5h15A1.5 1.5 0 0 1 21 6.5v11A1.5 1.5 0 0 1 19.5 19h-15A1.5 1.5 0 0 1 3 17.5v-11Z" fill="currentColor"></path>
										<path d="M4 6l8 6 8-6" fill="none" stroke="white" stroke-width="1.5"></path>
									</svg>
								</span>
								<div class="site-footer__info-text">
									<a href="<?php echo esc_url('mailto:' . sanitize_email($footer_email)); ?>">
										<?php echo esc_html($footer_email); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="site-footer__col site-footer__col--support">
					<?php if (!empty($footer_support_title)) : ?>
						<h2 class="site-footer__heading"><?php echo esc_html($footer_support_title); ?></h2>
					<?php endif; ?>

					<?php if (!empty($footer_support_text)) : ?>
						<div class="site-footer__text">
							<?php echo wp_kses_post(wpautop($footer_support_text)); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<a class="site-footer__to-top" href="#top" aria-label="<?php esc_attr_e('Back to top', 'pontus-zenergija'); ?>">
				<span class="site-footer__to-top-icon" aria-hidden="true">↑</span>
				<span class="site-footer__to-top-text"><?php echo esc_html($footer_back_to_top_label); ?></span>
			</a>
		</div>
	</div>