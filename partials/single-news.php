<section class="section-full single-news" id="single-news">
	<h2 class="visually-hidden">
		<?php the_title(); ?>
	</h2>
	<div class="container single-news__container">
		<div class="single-news__content descr">
			<?php the_content(); ?>
		</div>

		<?php if (!empty($gallery = get_field('news_gallery'))): ?>
			<div class="single-news__gallery single-news-gallery">
				<h3 class="single-news-gallery__title title-3">
					Фотогалерея
				</h3>
				<div class="swiper single-news-swiper" data-swiper="{'slidesPerView': 1, 'spaceBetween': 20, 'rewind': true, 'breakpoints': {'768': {'slidesPerView': 2},'1024': {'slidesPerView': 3}}}">
					<div class="swiper-wrapper single-news-swiper__wrapper"
						>
						<?php foreach ($gallery as $photo): ?>
							<div class="swiper-slide single-news-slide">
								<a class="single-news-slide__wrapper image-box" href="<?= esc_url($photo['url']); ?>"
									data-fancybox="news-single-gallery-<?= esc_attr(get_the_ID()) ?>">
									<?php echo wp_get_attachment_image(
										$photo['ID'],
										'large',
										false,
										array(
											'class' => 'img',
											'alt' => $photo['alt'] ?: '',
											'loading' => 'lazy'
										)
									); ?>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-btn-box">
					<button class="swiper-btn swiper-btn__prev single-news-swiper__btn single-news-swiper__btn-prev"
						type="button" aria-label="Назад" data-swiper-btn-prev=".single-news-swiper"></button>
					<button class="swiper-btn swiper-btn__next single-news-swiper__btn single-news-swiper__btn-next"
						type="button" aria-label="Вперёд" data-swiper-btn-prev=".single-news-swiper"></button>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>