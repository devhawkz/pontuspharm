<?php
if (!defined('ABSPATH')) {
	exit;
}

$topbar_enabled = (bool) pontus_get_header_setting('topbar_enabled', true);
$topbar_text    = pontus_get_translated_topbar_text(
	__('PROBAVNA ZENERGIJA — POUZDAN SADRŽAJ O PROBAVNOM ZDRAVLJU', 'pontus-zenergija')
);
$topbar_link    = pontus_get_header_setting('topbar_link', home_url('/'));

$instagram_url  = pontus_get_header_setting('social_instagram_url', '');
$facebook_url   = pontus_get_header_setting('social_facebook_url', '');
$youtube_url    = pontus_get_header_setting('social_youtube_url', '');

if (!$topbar_enabled || empty($topbar_text)) {
	return;
}
?>

<div class="site-topbar" aria-label="<?php esc_attr_e('Announcement bar', 'pontus-zenergija'); ?>">
	<div class="site-topbar__inner pontus-container">
		<div class="site-topbar__spacer" aria-hidden="true"></div>

		<a class="site-topbar__announcement" href="<?php echo esc_url($topbar_link); ?>">
			<span class="site-topbar__announcement-text">
				<?php echo esc_html($topbar_text); ?>
			</span>
			<span class="site-topbar__arrow" aria-hidden="true">→</span>
		</a>

		<div class="site-topbar__socials" aria-label="<?php esc_attr_e('Social links', 'pontus-zenergija'); ?>">
			<?php if (!empty($instagram_url)) : ?>
				<a
					class="site-topbar__social-link"
					href="<?php echo esc_url($instagram_url); ?>"
					target="_blank"
					rel="noopener noreferrer"
					aria-label="<?php esc_attr_e('Instagram', 'pontus-zenergija'); ?>"
				>
					<svg class="site-topbar__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<rect x="3" y="3" width="18" height="18" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
						<circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
						<circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"></circle>
					</svg>
				</a>
			<?php endif; ?>

			<?php if (!empty($facebook_url)) : ?>
				<a
					class="site-topbar__social-link"
					href="<?php echo esc_url($facebook_url); ?>"
					target="_blank"
					rel="noopener noreferrer"
					aria-label="<?php esc_attr_e('Facebook', 'pontus-zenergija'); ?>"
				>
					<svg class="site-topbar__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M13.5 21V12.8H16.3L16.7 9.8H13.5V7.9C13.5 7 13.8 6.4 15.1 6.4H16.8V3.7C16.5 3.6 15.5 3.5 14.3 3.5C11.8 3.5 10.2 5 10.2 7.8V9.8H7.5V12.8H10.2V21Z" fill="currentColor"></path>
					</svg>
				</a>
			<?php endif; ?>

			<?php if (!empty($youtube_url)) : ?>
				<a
					class="site-topbar__social-link"
					href="<?php echo esc_url($youtube_url); ?>"
					target="_blank"
					rel="noopener noreferrer"
					aria-label="<?php esc_attr_e('YouTube', 'pontus-zenergija'); ?>"
				>
					<svg class="site-topbar__social-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M21 8.2C20.8 7.2 20 6.4 19 6.2C17.3 5.8 12 5.8 12 5.8C12 5.8 6.7 5.8 5 6.2C4 6.4 3.2 7.2 3 8.2C2.6 9.9 2.6 12 2.6 12C2.6 12 2.6 14.1 3 15.8C3.2 16.8 4 17.6 5 17.8C6.7 18.2 12 18.2 12 18.2C12 18.2 17.3 18.2 19 17.8C20 17.6 20.8 16.8 21 15.8C21.4 14.1 21.4 12 21.4 12C21.4 12 21.4 9.9 21 8.2Z" fill="none" stroke="currentColor" stroke-width="1.6"></path>
						<path d="M10.3 15.2L15.1 12L10.3 8.8V15.2Z" fill="currentColor"></path>
					</svg>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>