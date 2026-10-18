<?php 
$label = $args['label'] ?? '';
$title = $args['title'] ?? '';
$descr = $args['descr'] ?? '';
$class = $args['class'] ?? '';
?>
<?php if (!empty($label) || !empty($title) || !empty($descr)): ?>
	<div class="section-header <?php echo esc_attr($class) ?>">
		<?php if (!empty($label)): ?>
			<span class="section-header__label">
				<?php echo esc_html($label) ?>
			</span>
		<?php endif; ?>
		<?php if (!empty($title)): ?>
			<h2 class="section-header__title title-2">
				<?php echo esc_html($title) ?>
			</h2>
		<?php endif; ?>
		<?php if (!empty($descr)): ?>
			<div class="section-header__descr descr">
				<?php echo wp_kses_post($descr) ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>