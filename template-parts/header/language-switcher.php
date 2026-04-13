<?php
if (!defined('ABSPATH')) {
	exit;
}

$context = isset($args['context']) && $args['context'] === 'mobile' ? 'mobile' : 'desktop';

if (!function_exists('pll_the_languages')) {
	return;
}

$languages = pll_the_languages([
	'raw'           => 1,
	'hide_if_empty' => 0,
	'hide_current'  => 0,
]);

if (empty($languages) || !is_array($languages) || count($languages) < 2) {
	return;
}

$current_language = null;

foreach ($languages as $language) {
	if (!empty($language['current_lang'])) {
		$current_language = $language;
		break;
	}
}

if (!$current_language) {
	$current_language = reset($languages);
}

$current_label = !empty($current_language['slug'])
	? strtoupper((string) $current_language['slug'])
	: strtoupper((string) ($current_language['locale'] ?? ''));

if ($context === 'mobile') : ?>
	<div class="site-mobile-panel__lang-switcher" aria-label="<?php esc_attr_e('Language switcher', 'pontus-zenergija'); ?>">
		<ul>
			<?php foreach ($languages as $language) : ?>
				<?php
				$is_current = !empty($language['current_lang']);
				$label      = !empty($language['slug'])
					? strtoupper((string) $language['slug'])
					: strtoupper((string) ($language['locale'] ?? ''));
				?>
				<li class="<?php echo $is_current ? 'current-lang' : ''; ?>">
					<a
						href="<?php echo esc_url((string) $language['url']); ?>"
						lang="<?php echo esc_attr((string) ($language['locale'] ?? '')); ?>"
						hreflang="<?php echo esc_attr((string) ($language['slug'] ?? '')); ?>"
						<?php echo $is_current ? 'aria-current="page"' : ''; ?>
					>
						<?php echo esc_html($label); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else : ?>
	<div class="site-header__lang-switcher js-lang-switcher" data-lang-switcher>
		<button
			class="site-header__lang-toggle js-lang-toggle"
			type="button"
			aria-expanded="false"
			aria-haspopup="true"
			aria-controls="site-header-lang-dropdown"
		>
			<span class="site-header__lang-icon" aria-hidden="true">
				<svg class="site-header__lang-icon-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
					<path d="M3 12H21" stroke="currentColor" stroke-width="1.6"/>
					<path d="M12 3C14.5 5.6 16 8.7 16 12C16 15.3 14.5 18.4 12 21" stroke="currentColor" stroke-width="1.6"/>
					<path d="M12 3C9.5 5.6 8 8.7 8 12C8 15.3 9.5 18.4 12 21" stroke="currentColor" stroke-width="1.6"/>
				</svg>
			</span>

			<span class="site-header__lang-current">
				<?php echo esc_html($current_label); ?>
			</span>

			<span class="site-header__lang-chevron" aria-hidden="true"></span>
		</button>

		<div
			id="site-header-lang-dropdown"
			class="site-header__lang-dropdown js-lang-dropdown"
			hidden
		>
			<ul class="site-header__lang-list">
				<?php foreach ($languages as $language) : ?>
					<?php
					$is_current = !empty($language['current_lang']);
					if ($is_current) {
						continue;
					}
					$label      = !empty($language['slug'])
						? strtoupper((string) $language['slug'])
						: strtoupper((string) ($language['locale'] ?? ''));
					?>
					<li class="site-header__lang-item">
						<a
							class="site-header__lang-link"
							href="<?php echo esc_url((string) $language['url']); ?>"
							lang="<?php echo esc_attr((string) ($language['locale'] ?? '')); ?>"
							hreflang="<?php echo esc_attr((string) ($language['slug'] ?? '')); ?>"
						>
							<?php echo esc_html($label); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>