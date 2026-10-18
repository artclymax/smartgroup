<?php
// Получаем текущую категорию
$term = get_queried_object();
// Пытаемся получить выбранные категории из ACF
$selected_cats = get_field('cat_children_selected', $term) ?? [];

// Если ничего не выбрано — получаем все дочерние категории
if (empty($selected_cats) || is_wp_error($selected_cats)) {
	$categories = get_terms([
		'taxonomy' => 'product_cat',
		'parent' => $term->term_id,
		'hide_empty' => true,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	]);
} else {
	// Используем выбранные категории
	$categories = $selected_cats;
}
?>

<?php if (!empty($categories) && !is_wp_error($categories)): ?>
	<section class="section category-children-list" id="category-children-list">
		<div class="container category-children-list__container">
			<ul class="category-children-list__list grid">
				<?php foreach ($categories as $cat):
					// Получаем ACF поля карточки категории
					$cat_image = get_field('cat_card_image', $cat) ?? null;
					$cat_title = get_field('cat_card_title', $cat) ?: $cat->name;
					$cat_descr = get_field('cat_card_descr', $cat) ?: term_description($cat->term_id);

					// Получаем ссылку на категорию
					$term_link = get_term_link($cat);
					?>
					<?php if (!is_wp_error($term_link)): ?>
						<li class="category-children-list__item catalog-item">
							<a class="catalog-item__link" href="<?php echo esc_url($term_link); ?>">

								<?php if ($cat_image && is_array($cat_image) && !empty($cat_image['ID'])): ?>
									<div class="catalog-item__image image-box">
										<?php echo wp_get_attachment_image(
											$cat_image['ID'],
											'medium_large',
											false,
											[
												'class' => 'img',
												'alt' => $cat_image['alt'] ?: $cat_title,
												'loading' => 'lazy'
											]
										); ?>
									</div>
								<?php endif; ?>

								<div class="catalog-item__content">
									<h3 class="catalog-item__title title-4">
										<?php echo esc_html($cat_title); ?>
									</h3>

									<?php if ($cat_descr): ?>
										<div class="catalog-item__descr descr">
											<?php echo wp_kses_post($cat_descr); ?>
										</div>
									<?php endif; ?>

									<span class="catalog-item__btn link-arrow">Подробнее</span>
								</div>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>