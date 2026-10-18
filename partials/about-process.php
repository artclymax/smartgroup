<?php
$page = get_queried_object();

$label = get_field('about_process_label', $page) ?? '';
$title = get_field('about_process_title', $page) ?? '';
$descr = get_field('about_process_descr', $page) ?? '';
$list = get_field('about_process_list', $page) ?? [];
?>

<?php if ($label || $title || $descr || !empty($list)): ?>
	<section class="section-full about-process" id="about-process">
		<div class="container about-process__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
			]); ?>

			<?php if (!empty($list)): ?>
				<div class="swiper about-process-swiper"
					data-swiper='{ "slidesPerView": 1.5, "rewind": true, "breakpoints": { "560": { "slidesPerView": 2 }, "768": { "slidesPerView": 3 }, "1024": { "slidesPerView": 4 }, "1200": { "slidesPerView": 5 } } }'>

					<div class="swiper-wrapper about-process-swiper__wrapper">
						<?php foreach ($list as $index => $item):
							$image = $item['image'] ?? null;
							$item_title = $item['title'] ?? '';
							$item_descr = $item['descr'] ?? '';

							$number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
							?>
							<div class="swiper-slide about-process-slide">
								<div class="about-process-slide__wrapper">

									<div class="about-process-slide__header">
										<div class="about-process-slide__number title-1">
											<?php echo esc_html($number); ?>
										</div>

										<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
											<div class="about-process-slide__icon">
												<?php echo wp_get_attachment_image(
													$image['ID'],
													'large',
													false,
													[
														'class' => 'img',
														'alt' => $image['alt'] ?: $item_title,
														'loading' => 'lazy'
													]
												); ?>
											</div>
										<?php endif; ?>
									</div>

									<?php if ($item_title): ?>
										<h3 class="about-process-slide__title title-4">
											<?php echo esc_html($item_title); ?>
										</h3>
									<?php endif; ?>

									<?php if ($item_descr): ?>
										<div class="about-process-slide__descr descr">
											<?php echo wp_kses_post($item_descr); ?>
										</div>
									<?php endif; ?>

								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="swiper-btn-box visible-mobile">
						<button class="swiper-btn swiper-btn__prev about-process-swiper__btn about-process-swiper__btn-prev"
							type="button" aria-label="Назад" data-swiper-btn-prev=".about-process-swiper"></button>
						<button class="swiper-btn swiper-btn__next about-process-swiper__btn about-process-swiper__btn-next"
							type="button" aria-label="Вперёд" data-swiper-btn-next=".about-process-swiper"></button>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>