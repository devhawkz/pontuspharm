<?php
if (!defined('ABSPATH')) {
	exit;
}

$context = isset($args['context']) && $args['context'] === 'mobile' ? 'mobile' : 'desktop';

if ($context === 'mobile') : ?>
	<nav class="site-mobile-panel__nav" aria-label="<?php esc_attr_e('Mobile menu', 'pontus-zenergija'); ?>">
		<?php
		wp_nav_menu([
			'theme_location' => 'primary_menu',
			'container'      => false,
			'menu_class'     => 'site-mobile-panel__menu',
			'fallback_cb'    => false,
			'depth'          => 2,
		]);
		?>
	</nav>
<?php else : ?>
	<nav class="site-header__nav" aria-label="<?php esc_attr_e('Primary menu', 'pontus-zenergija'); ?>">
		<?php
		wp_nav_menu([
			'theme_location' => 'primary_menu',
			'container'      => false,
			'menu_class'     => 'site-header__menu',
			'fallback_cb'    => false,
			'depth'          => 2,
		]);
		?>
	</nav>
<?php endif; ?>