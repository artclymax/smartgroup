<?php
$term = get_queried_object();
$label = get_field('cat_about_label', $term) ?? '';
$title = get_field('cat_about_title', $term) ?? '';
$descr = get_field('cat_about_descr', $term) ?? '';
$image = get_field('cat_about_image', $term) ?? null;
?>

<?php if ($label || $title || $descr || ($image && !empty($image['ID']))): ?>
	<section class="section category-about" id="category-about">
		<div class="container category-about__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
				'descr' => $descr
			]); ?>

			<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
				<div class="category-about__image image-box">
					<?php echo wp_get_attachment_image(
						$image['ID'],
						'large',
						false,
						[
							'class' => 'img',
							'alt' => $image['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>