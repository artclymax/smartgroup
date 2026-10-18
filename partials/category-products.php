<?php
// Получаем текущую категорию
$current_terms = get_queried_object();

if (!$current_terms || !isset($current_terms->taxonomy) || $current_terms->taxonomy !== 'product_cat') {
	return; // Защита: выводим только на страницах product_cat
}

// ACF поля таксономии
$show_product = get_field('category_products_show_product', $current_terms) ?? true;
$title = get_field('category_products_title', $current_terms) ?: 'Состав оборудования';

// Если отключено — не выводим секцию
if (!$show_product) {
	return;
}

$args = [
	'post_type' => 'product',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish',
	'tax_query' => [
		[
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $current_terms->slug
		]
	]
];

$query = new WP_Query($args);

if ($query->have_posts()): ?>
	<section class="section category-products" id="category-products">
		<div class="container category-products__container">

			<?php if ($title): ?>
				<h2 class="category-products__title title-2">
					<?php echo esc_html($title); ?>
				</h2>
			<?php endif; ?>

			<!-- 👈 ИСПРАВЛЕНО: Валидный JSON (двойные кавычки внутри одинарных) -->
			<div class="swiper category-products-swiper"
				data-swiper='{ "slidesPerView": 1, "spaceBetween": 20, "rewind": true, "breakpoints": { "768": { "slidesPerView": 2 }, "992": { "slidesPerView": 3 }, "1024": { "slidesPerView": 4 } } }'>

				<div class="swiper-wrapper category-products-swiper__wrapper">
					<?php while ($query->have_posts()):
						$query->the_post();
						$image_id = get_post_thumbnail_id();
						?>
						<div class="swiper-slide category-products-slide">
							<a class="category-products-slide__wrapper" href="<?php the_permalink() ?>">
								<?php if ($image_id): ?>
									<div class="category-products-slide__image image-box">
										<?php echo wp_get_attachment_image(
											$image_id,
											'medium_large',
											false,
											[
												'class' => 'img',
												'alt' => get_the_title(),
												'loading' => 'lazy'
											]
										); ?>
									</div>
								<?php endif; ?>

								<h3 class="category-products-slide__title link-arrow">
									<?php echo esc_html(get_the_title()); ?>
								</h3>
							</a>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>

				<div class="swiper-pagination category-products-swiper__pagination hidden-mobile"
					data-swiper-pagination=".category-products-swiper"></div>

				<div class="swiper-btn-box visible-mobile">
					<button class="swiper-btn swiper-btn__prev category-products-swiper__btn category-products-swiper__btn-prev"
						type="button" aria-label="Назад" data-swiper-btn-prev=".category-products-swiper"></button>
					<button class="swiper-btn swiper-btn__next category-products-swiper__btn category-products-swiper__btn-next"
						type="button" aria-label="Вперёд" data-swiper-btn-next=".category-products-swiper"></button>
				</div>

			</div>
		</div>
	</section>
<?php endif; ?>