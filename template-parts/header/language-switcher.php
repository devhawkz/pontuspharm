<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('pll_the_languages')) {
	return;
}

$languages = pll_the_languages([
	'raw'           => 1,
	'hide_if_empty' => 0,
	'hide_current'  => 0,
]);

if (empty($languages) || !is_array($languages)) {
	return;
}

$current_language = null;
$other_languages  = [];

foreach ($languages as $language) {
	if (!empty($language['current_lang'])) {
		$current_language = $language;
	} else {
		$other_languages[] = $language;
	}
}

if (!$current_language) {
	return;
}

$current_slug = !empty($current_language['slug']) ? strtoupper($current_language['slug']) : '';
?>

<div class="site-header__lang-switcher js-lang-switcher">
	<button
		class="site-header__lang-toggle js-lang-toggle"
		type="button"
		aria-expanded="false"
		aria-haspopup="true"
		aria-controls="site-header-lang-dropdown"
		aria-label="<?php esc_attr_e('Language switcher', 'pontus-zenergija'); ?>"
	>
		<span class="site-header__lang-icon" aria-hidden="true">
			<svg class="site-header__lang-icon-svg" viewBox="0 0 24 24" focusable="false">
				<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
				<path d="M3 12h18" fill="none" stroke="currentColor" stroke-width="1.8"></path>
				<path d="M12 3a14 14 0 0 1 0 18" fill="none" stroke="currentColor" stroke-width="1.8"></path>
				<path d="M12 3a14 14 0 0 0 0 18" fill="none" stroke="currentColor" stroke-width="1.8"></path>
			</svg>
		</span>

		<span class="site-header__lang-current">
			<?php echo esc_html($current_slug); ?>
		</span>

		<span class="site-header__lang-chevron" aria-hidden="true"></span>
	</button>

	<?php if (!empty($other_languages)) : ?>
		<div
			class="site-header__lang-dropdown js-lang-dropdown"
			id="site-header-lang-dropdown"
			hidden
		>
			<ul class="site-header__lang-list">
				<?php foreach ($other_languages as $language) : ?>
					<?php
					$lang_slug = !empty($language['slug']) ? strtoupper($language['slug']) : '';
					$lang_url  = !empty($language['url']) ? $language['url'] : '#';
					?>
					<li class="site-header__lang-item">
						<a class="site-header__lang-link" href="<?php echo esc_url($lang_url); ?>">
							<?php echo esc_html($lang_slug); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>