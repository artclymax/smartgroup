<?php
$page = get_queried_object();

$label = get_field('suppliers_offer_label', $page) ?? '';
$title = get_field('suppliers_offer_title', $page) ?? '';
$list = get_field('suppliers_offer_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section suppliers-offer" id="suppliers-offer">
		<div class="container suppliers-offer__container">

			<?php get_template_part('partials/section-header', null, [
				'class' => 'section-header--two',
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="suppliers-offer__list">
					<?php foreach ($list as $item):
						$item_title = $item['title'] ?? '';
						$item_descr = $item['descr'] ?? '';

						if (!$item_title && !$item_descr)
							continue;
						?>
						<li class="suppliers-offer__item suppliers-offer-item">
							<div class="suppliers-offer-item__content">

								<?php if ($item_title): ?>
									<h3 class="suppliers-offer-item__title">
										<?php echo esc_html($item_title); ?>
									</h3>
								<?php endif; ?>

								<?php if ($item_descr): ?>
									<div class="suppliers-offer-item__descr descr">
										<?php echo wp_kses_post($item_descr); ?>
									</div>
								<?php endif; ?>

							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>