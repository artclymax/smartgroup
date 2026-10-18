<?php
$term = get_queried_object();

if (!$term || !isset($term->taxonomy) || $term->taxonomy !== 'product_cat') {
	return; // Защита: выводим только на страницах product_cat
}

$title = get_field('category_specs_title', $term) ?: 'Технические характеристики';
$list = get_field('category_specs_list', $term) ?? [];
?>

<?php if (!empty($list)): ?>
	<section class="section-full category-specs" id="category-specs">
		<div class="container category-specs__container">

			<?php if ($title): ?>
				<h2 class="category-specs__title title-2">
					<?php echo esc_html($title); ?>
				</h2>
			<?php endif; ?>

			<?php if (!empty($list)): ?>
				<ul class="category-specs__grid" data-hide-list="3">
					<?php foreach ($list as $item):
						$item_key = $item['key'] ?? '';
						$item_value = $item['value'] ?? '';
						?>
						<?php if ($item_key || $item_value): ?>
							<li class="category-specs__item category-specs-item">
								<?php if ($item_key): ?>
									<p class="category-specs-item__key">
										<?php echo esc_html($item_key); ?>
									</p>
								<?php endif; ?>

								<?php if ($item_value): ?>
									<p class="category-specs-item__value">
										<?php echo esc_html($item_value); ?>
									</p>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<button class="category-specs__btn btn btn--stroke visible-mobile" data-hide-list-btn>Показать полностью</button>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>