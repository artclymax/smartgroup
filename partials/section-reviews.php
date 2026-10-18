<?php
$page = 'option';
$label = get_field('reviews_section_label', $page) ?? '';
$title = get_field('reviews_section_title', $page) ?? '';
$descr = get_field('reviews_section_descr', $page) ?? '';

$args = [
	'post_type' => 'review',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
];

$query = new WP_Query($args);

if ($query->have_posts()): ?>
	<section class="section-full section-reviews" id="section-reviews">
		<div class="container section-reviews__container">
			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
				'descr' => $descr
			]); ?>
			<div class="swiper section-reviews-swiper"
				data-swiper="{'slidesPerView': 1, 'spaceBetween': 20, 'loop': true, 'breakpoints': {'768': {'slidesPerView': 2},'1024': {'slidesPerView': 3}}}">
				<div class="swiper-wrapper section-reviews-swiper__wrapper">
					<?php while ($query->have_posts()):
						$query->the_post();
						$company = get_field('review_company') ?? '';
						?>
						<div class="swiper-slide section-reviews-slide">
							<div class="section-reviews-slide__wrapper reviews-item">
								<div class="reviews-item__icon icon icon--review"></div>
								<div class="reviews-item__descr descr">
									<?php the_content() ?>
								</div>
								<div class="reviews-item__meta">
									<h3 class="reviews-item__author title-4">
										<?php the_title() ?>
									</h3>
									<?php if (!empty($company)): ?>
										<div class="reviews-item__company">
											<?php echo esc_html($company) ?>
										</div>
									<?php endif; ?>
								</div>

							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
				<div class="swiper-pagination section-reviews-swiper__pagination hidden-mobile"
					data-swiper-pagination=".section-reviews-swiper"></div>
				<div class="swiper-btn-box">
					<button
						class="swiper-btn swiper-btn__prev section-reviews-swiper__btn section-reviews-swiper__btn-prev visible-mobile"
						type="button" aria-label="Назад" data-swiper-btn-prev=".section-reviews-swiper"></button>
					<button
						class="swiper-btn swiper-btn__next section-reviews-swiper__btn section-reviews-swiper__btn-next visible-mobile"
						type="button" aria-label="Вперёд" data-swiper-btn-next=".section-reviews-swiper"></button>
				</div>

			</div>
		</div>
	</section>
<?php endif; ?>