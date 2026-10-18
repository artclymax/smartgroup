<?php
$page = get_queried_object();

$label = get_field('services_process_label', $page) ?? '';
$title = get_field('services_process_title', $page) ?? '';
$list = get_field('services_process_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section services-process" id="services-process">
		<div class="container services-process__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<div class="swiper services-process-swiper"
					data-swiper='{ "slidesPerView": 1.5, "rewind": true, "breakpoints": { "560": { "slidesPerView": 2 }, "768": { "slidesPerView": 3 }, "1024": { "slidesPerView": 4 } } }'>

					<div class="swiper-wrapper services-process-swiper__wrapper">
						<?php foreach ($list as $index => $item):
							$item_title = $item['title'] ?? '';
							$item_descr = $item['descr'] ?? '';

							$number = ++$index > 9 ? $index : '0' . $index;
							?>
							<div class="swiper-slide services-process-slide">
								<div class="services-process-slide__wrapper">

									<div class="services-process-slide__header">
										<div class="services-process-slide__number title-1">
											<?php echo esc_html($number); ?>
										</div>
									</div>

									<?php if ($item_title): ?>
										<h3 class="services-process-slide__title title-4">
											<?php echo esc_html($item_title); ?>
										</h3>
									<?php endif; ?>

									<?php if ($item_descr): ?>
										<div class="services-process-slide__descr descr">
											<?php echo wp_kses_post($item_descr); ?>
										</div>
									<?php endif; ?>

								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="swiper-btn-box visible-mobile">
						<button class="swiper-btn swiper-btn__prev services-process-swiper__btn services-process-swiper__btn-prev"
							type="button" aria-label="Назад" data-swiper-btn-prev=".services-process-swiper"></button>
						<button class="swiper-btn swiper-btn__next services-process-swiper__btn services-process-swiper__btn-next"
							type="button" aria-label="Вперёд" data-swiper-btn-next=".services-process-swiper"></button>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>