<?php
$page = get_queried_object();

$label = get_field('suppliers_about_label', $page) ?? '';
$descr = get_field('suppliers_about_descr', $page) ?? '';
$image = get_field('suppliers_about_image', $page) ?? null;
?>

<?php if ($label || $descr || ($image && !empty($image['ID']))): ?>
	<div class="section suppliers-about" id="suppliers-about">
		<div class="container suppliers-about__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'descr' => $descr
			]); ?>

		</div>

		<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
			<div class="suppliers-about__image image-box">
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