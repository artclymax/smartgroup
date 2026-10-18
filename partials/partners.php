<?php
$page = 'option';

$label = get_field('partners_label', $page) ?? '';
$title = get_field('partners_title', $page) ?? '';
$descr = get_field('partners_descr', $page) ?? '';
$gallery = get_field('partners_gallery', $page) ?? [];
?>

<?php if ($label || $title || $descr || !empty($gallery)): ?>
	<section class="section partners" id="partners">
		<div class="container partners__container">
			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
				'descr' => $descr
			]); ?>
		</div>

		<?php if (!empty($gallery)): ?>
			<div class="partners" data-running-line>
				<div class="partners__list" data-running-line-list>
					<?php foreach ($gallery as $image):
						$image_id = $image['ID'] ?? null;
						if (!$image_id)
							continue;
						?>
						<div class="partners__item">
							<div class="partners__item-inner images-box">
								<?php echo wp_get_attachment_image(
									$image_id,
									'medium_large',
									false,
									[
										'class' => 'img',
										'alt' => $image['alt'] ?: $title,
										'loading' => 'lazy'
									]
								); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>