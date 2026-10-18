<?php
$page = get_queried_object();

$label = get_field('section_news_label', $page) ?? '';
$title = get_field('section_news_title', $page) ?? '';
$descr = get_field('section_news_descr', $page) ?? '';
$btn = get_field('section_news_btn', $page) ?? [];

if (empty($btn) || empty($btn['url'])) {
	$btn = [
		'url' => get_post_type_archive_link('news') ?: home_url('/news/'),
		'title' => 'Все новости'
	];
}

// Получаем 3 последние новости
$news_query = new WP_Query([
	'post_type' => 'news',
	'posts_per_page' => 6,
	'post_status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC',
]);
?>

<?php if ($label || $title || $descr || $news_query->have_posts()): ?>
	<section class="section section-news" id="section-news">
		<div class="container section-news__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
				'descr' => $descr
			]); ?>

			<?php if ($news_query->have_posts()): ?>
				<div class="swiper section-news-swiper"
					data-swiper='{ "slidesPerView": 1, "rewind": true, "spaceBetween": 30, "breakpoints": { "768": { "slidesPerView": 2 }, "1024": { "slidesPerView": 3 } } }'>

					<div class="swiper-wrapper section-news-swiper__wrapper">
						<?php while ($news_query->have_posts()):
							$news_query->the_post();
							$image_id = get_post_thumbnail_id();
							$excerpt = get_the_excerpt();
							?>
							<div class="swiper-slide section-news-slide">
								<a class="section-news-slide__wrapper-link" href="<?php echo esc_url(get_permalink()); ?>">

									<?php if ($image_id): ?>
										<div class="section-news-slide__image image-box">
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

									<div class="section-news-slide__content">
										<div class="section-news-slide__meta icon icon--after icon--arrow-right">
											<time class="section-news-slide__date icon icon--date"
												datetime="<?php echo get_the_date('c'); ?>">
												<?php echo esc_html(get_the_date('d.m.Y')); ?>
											</time>
										</div>

										<h3 class="section-news-slide__title">
											<?php echo esc_html(get_the_title()); ?>
										</h3>

										<?php if ($excerpt): ?>
											<div class="section-news-slide__descr descr">
												<?php echo wp_kses_post($excerpt); ?>
											</div>
										<?php endif; ?>
									</div>

								</a>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>

					<div class="swiper-pagination section-news-swiper__pagination hidden-mobile" data-swiper-pagination=".section-news-swiper">
					</div>

					<div class="swiper-btn-box visible-mobile">
						<button class="swiper-btn swiper-btn__prev section-news-swiper__btn section-news-swiper__btn-prev"
							type="button" aria-label="Назад" data-swiper-btn-prev=".section-news-swiper"></button>
						<button class="swiper-btn swiper-btn__next section-news-swiper__btn section-news-swiper__btn-next"
							type="button" aria-label="Вперёд" data-swiper-btn-next=".section-news-swiper"></button>
					</div>

				</div>
			<?php endif; ?>

			<?php if (!empty($btn) && !empty($btn['url'])): ?>
				<a class="section-news__btn btn btn--light" href="<?php echo esc_url($btn['url']); ?>">
					<?php echo esc_html($btn['title']); ?>
				</a>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>