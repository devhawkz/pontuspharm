<?php
if (!defined('ABSPATH')) {
	exit;
}

$footer_copyright     = pontus_get_translated_footer_setting('footer_copyright', '© 2026');
$footer_legal_label   = pontus_get_translated_footer_setting('footer_legal_label', __('Pravne informacije', 'pontus-zenergija'));
$footer_legal_url     = pontus_get_translated_footer_setting('footer_legal_url', '');
$footer_privacy_label = pontus_get_translated_footer_setting('footer_privacy_label', __('Politika privatnosti', 'pontus-zenergija'));
$footer_privacy_url   = pontus_get_translated_footer_setting('footer_privacy_url', '');
$footer_credit_text   = pontus_get_translated_footer_setting('footer_credit_text', '');
?>

	<div class="site-footer__bottom">
		<div class="site-footer__bottom-inner pontus-container">
			<div class="site-footer__bottom-left">
				<?php if (!empty($footer_copyright)) : ?>
					<span class="site-footer__bottom-text"><?php echo esc_html($footer_copyright); ?></span>
				<?php endif; ?>

				<?php if (!empty($footer_legal_label) && !empty($footer_legal_url)) : ?>
					<a class="site-footer__bottom-link" href="<?php echo esc_url($footer_legal_url); ?>">
						<?php echo esc_html($footer_legal_label); ?>
					</a>
				<?php endif; ?>

				<?php if (!empty($footer_privacy_label) && !empty($footer_privacy_url)) : ?>
					<a class="site-footer__bottom-link" href="<?php echo esc_url($footer_privacy_url); ?>">
						<?php echo esc_html($footer_privacy_label); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if (!empty($footer_credit_text)) : ?>
				<div class="site-footer__bottom-right">
					<span class="site-footer__bottom-credit"><?php echo esc_html($footer_credit_text); ?></span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>