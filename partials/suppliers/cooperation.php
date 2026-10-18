<?php
$page = get_queried_object();

$label = get_field('suppliers_cooperation_label', $page) ?? '';
$title = get_field('suppliers_cooperation_title', $page) ?? '';
$image = get_field('suppliers_cooperation_image', $page) ?? null;
?>

<?php if ($label || $title || ($image && !empty($image['ID']))): ?>
	<div class="section suppliers-cooperation" id="suppliers-cooperation">
		<div class="container suppliers-cooperation__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>

		</div>

		<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
			<div class="suppliers-cooperation__image image-box">
				<?php echo wp_get_attachment_image(
					$image['ID'],
					'large',
					false,
					[
						'class' => 'img',
						'alt' => $image['alt'] ?: $label,
						'loading' => 'lazy'
					]
				); ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>