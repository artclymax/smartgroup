<?php
$page = get_queried_object();

$label = get_field('catalog_label', $page) ?? '';
$title = get_field('catalog_title', $page) ?? '';
$descr = get_field('catalog_descr', $page) ?? '';
$btn = get_field('catalog_btn', $page) ?? [];

$selected_cats = get_terms([
	'taxonomy' => 'product_cat',
	'parent' => 0,
	'hide_empty' => false,
	'orderby' => 'menu_order',
	'order' => 'ASC'
]);

?>

<?php if ($label || $title || $descr || (!empty($btn) && !empty($btn['url'])) || (!empty($selected_cats) && !is_wp_error($selected_cats))): ?>
	<section class="section-full section-category" id="section-category">
		<div class="container section-category__container">

			<?php if (!empty($selected_cats) && !is_wp_error($selected_cats)): ?>
				<ul class="section-category__list grid">
					<?php foreach ($selected_cats as $term):
						$cat_image = get_field('cat_card_image', $term);
						$cat_title = get_field('cat_card_title', $term);
						$cat_descr = get_field('cat_card_descr', $term);
						$term_link = get_term_link($term);

						$final_title = $cat_title ?: $term->name;
						$final_descr = $cat_descr ?: term_description($term->term_id);
						?>
						<?php if (!is_wp_error($term_link)): ?>
							<li class="section-category__item catalog-item">
								<a class="catalog-item__link" href="<?php echo esc_url($term_link); ?>">

									<div class="catalog-item__image image-box">
									<?php if ($cat_image && is_array($cat_image) && !empty($cat_image['ID'])): ?>
											<?php echo wp_get_attachment_image(
												$cat_image['ID'],
												'medium_large',
												false,
												[
													'class' => 'img',
													'alt' => $cat_image['alt'] ?: $final_title,
													'loading' => 'lazy'
												]
											); ?>
									<?php endif; ?>
								</div>

									<div class="catalog-item__content">
										<h3 class="catalog-item__title title-4">
											<?php echo esc_html($final_title); ?>
										</h3>

										<?php if ($final_descr): ?>
											<div class="catalog-item__descr descr">
												<?php echo wp_kses_post($final_descr); ?>
											</div>
										<?php endif; ?>

										<span class="catalog-item__btn btn btn--stroke">Подробнее</span>
									</div>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if (!empty($btn) && !empty($btn['url'])): ?>
				<a class="catalog__btn btn" href="<?php echo esc_url($btn['url']); ?>">
					<?php echo esc_html($btn['title']); ?>
				</a>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>