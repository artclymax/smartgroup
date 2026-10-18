<?php
$page = get_queried_object();

$label = get_field('suppliers_market_label', $page) ?? '';
$title = get_field('suppliers_market_title', $page) ?? '';
$list = get_field('suppliers_market_list', $page) ?? [];
$image = get_field('suppliers_market_image', $page) ?? null;
$image_mobile = get_field('suppliers_market_image_mobile', $page) ?? null;
?>

<?php if ($label || $title || !empty($list) || ($image && !empty($image['ID'])) || ($image_mobile && !empty($image_mobile['ID']))): ?>
	<section class="section suppliers-market" id="suppliers-market">
		<div class="container suppliers-market__container">
			<div class="suppliers-market__content">
				<?php get_template_part('partials/section-header', null, [
					'label' => $label,
					'title' => $title
				]); ?>

				<?php if (!empty($list)): ?>
					<ul class="suppliers-market__list">
						<?php foreach ($list as $item):
							$item_descr = $item['descr'] ?? '';
							if (!$item_descr)
								continue;
							?>
							<li class="suppliers-market__item suppliers-market-item icon icon--big-checkmark">
								<div class="suppliers-market-item__descr descr">
									<?php echo wp_kses_post($item_descr); ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>
		</div>
		<?php if (($image && !empty($image['ID'])) || ($image_mobile && !empty($image_mobile['ID']))): ?>
			<div class="suppliers-market__image image-box">

				<?php if ($image && !empty($image['ID'])): ?>
					<?php echo wp_get_attachment_image(
						$image['ID'],
						'large',
						false,
						[
							'class' => 'img' . (!empty($image_mobile['ID']) ? ' hidden-mobile' : ''),
							'alt' => $image['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				<?php endif; ?>

				<?php if ($image_mobile && !empty($image_mobile['ID'])): ?>
					<?php echo wp_get_attachment_image(
						$image_mobile['ID'],
						'large',
						false,
						[
							'class' => 'img visible-mobile',
							'alt' => $image_mobile['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				<?php endif; ?>

			</div>
		<?php endif; ?>

	</section>
<?php endif; ?>