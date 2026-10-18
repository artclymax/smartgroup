<?php
global $product;

if (!$product instanceof WC_Product) {
	return;
}
// 1. Получаем миниатюру товара
$thumbnail_id = $product->get_image_id();

// 2. Получаем галерею WooCommerce и преобразуем в массив объектов
$gallery_ids = $product->get_gallery_image_ids();
$gallery = [];
foreach ($gallery_ids as $image_id) {
	$gallery[] = [
		'ID' => $image_id,
		'url' => wp_get_attachment_image_url($image_id, 'full'),
		'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $product->get_name(),
	];
}

// 3. Получаем видео из ACF repeater
$videos = get_field('product_videos') ?? [];

$media = false;

if (!empty($thumbnail_id) || !empty($gallery) || !empty($videos)) {
	$media = true;
}

// Получаем данные из ACF полей товара
$specs = get_field('product_specs') ?? [];
$docs = get_field('product_docs') ?? [];

?>

<section class="section product-details" id="product-details">
	<div class="container product-details__container">

		<!-- Табы показываем только если их больше одного -->
		<ul class="product-details__links product-details-links">
			<?php if (!empty($specs)): ?>
				<li class="product-details-links__item">
					<a class="product-details-links__link btn btn--stroke" href="#product-specs" data-tab-link>
						Характеристики
					</a>
				</li>
			<?php endif; ?>
			<?php if (!empty($media)): ?>
				<li class="product-details-links__item">
					<a class="product-details-links__link btn btn--stroke" href="#product-media" data-tab-link>
						Фото / видео
					</a>
				</li>
			<?php endif; ?>
			<?php if (!empty($docs)): ?>
				<li class="product-details-links__item">
					<a class="product-details-links__link btn btn--stroke" href="#product-docs" data-tab-link>
						Документация
					</a>
				</li>
			<?php endif; ?>
		</ul>

		<!-- SPECS -->
		<?php if (!empty($specs)): ?>
			<article class="product-details__article product-details-tab" id="product-specs" data-tab>
				<h3 class="product-details-tab__title title-3">
					Характеристики
				</h3>

				<ul class="product-details-tab__specs product-details-specs" data-hide-list="3">
					<?php foreach ($specs as $item):
						$item_key = $item['key'] ?? '';
						$item_value = $item['value'] ?? '';

						if (!$item_key && !$item_value)
							continue;
						?>
						<li class="product-details-specs__item">
							<?php if ($item_key): ?>
								<p class="product-details-specs__key">
									<?php echo esc_html($item_key); ?>
								</p>
							<?php endif; ?>

							<?php if ($item_value): ?>
								<p class="product-details-specs__value">
									<?php echo esc_html($item_value); ?>
								</p>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>

				<button class="product-details-tab__btn btn btn--stroke visible-mobile" type="button" data-hide-list-btn>
					Показать полностью
				</button>
			</article>
		<?php endif; ?>
		<!-- MEDIA -->
		<?php if (!empty($media)): ?>
			<article class="product-details__article product-details-tab" id="product-media" data-tab>
				<h3 class="product-details-tab__title title-3">
					Фото/видео
				</h3>
				<div class="product-details-tab__slider">
					<div class="swiper product-details-tab-swiper"
						data-swiper="{'slidesPerView': 1, 'spaceBetween': 10, 'rewind': true, 'breakpoints': {'768': {'slidesPerView': 2},'1024': {'slidesPerView': 3}}}">
						<div class="swiper-wrapper product-details-tab-swiper__wrapper">
							<!-- Миниатюра товара -->
							<?php if ($thumbnail_id): ?>
								<div class="swiper-slide product-details-tab-slide">
									<a class="product-details-tab-slide__wrapper-link image-box"
										href="<?php echo esc_url(wp_get_attachment_image_url($thumbnail_id, 'full')); ?>"
										data-fancybox="product-gallery-details">
										<?php echo wp_get_attachment_image(
											$thumbnail_id,
											'large',
											false,
											[
												'class' => 'img',
												'alt' => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: $product->get_name(),
												'loading' => 'eager'
											]
										); ?>
									</a>
								</div>
							<?php endif; ?>

							<!-- Изображения из галереи WooCommerce -->
							<?php if (!empty($gallery)): ?>
								<?php foreach ($gallery as $photo): ?>
									<div class="swiper-slide product-details-tab-slide">
										<a class="product-details-tab-slide__wrapper-link image-box"
											href="<?php echo esc_url($photo['url']); ?>" data-fancybox="product-gallery-details">
											<?php echo wp_get_attachment_image(
												$photo['ID'],
												'large',
												false,
												[
													'class' => 'img',
													'alt' => $photo['alt'],
													'loading' => 'lazy'
												]
											); ?>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>

							<!-- Видео из ACF -->
							<?php if (!empty($videos)): ?>
								<?php foreach ($videos as $video):
									$file = $video['file'] ?? null;
									$cover = $video['cover'] ?? null;

									if (!$file || empty($file['url']))
										continue;
									?>
									<div class="swiper-slide product-details-tab-slide">
										<a class="product-details-tab-slide__wrapper-link image-box slide-video"
											href="<?php echo esc_url($file['url']); ?>" data-fancybox="product-gallery-details">
											<?php if ($cover && !empty($cover['ID'])): ?>
												<?php echo wp_get_attachment_image(
													$cover['ID'],
													'full',
													false,
													[
														'class' => 'img',
														'alt' => $video['title'] ?? 'Видео'
													]
												); ?>
											<?php else: ?>
												<div class="product-details-tab-slide__video-icon"></div>
											<?php endif; ?>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>

						</div>
					</div>
					<div class="swiper-btn-box">
						<button
							class="swiper-btn swiper-btn__prev product-details-tab-swiper__btn product-details-tab-swiper__btn-prev"
							type="button" aria-label="Назад" data-swiper-btn-prev=".product-details-tab-swiper"></button>
						<button
							class="swiper-btn swiper-btn__next product-details-tab-swiper__btn product-details-tab-swiper__btn-next"
							type="button" aria-label="Вперёд" data-swiper-btn-next=".product-details-tab-swiper"></button>
					</div>
				</div>
			</article>
		<?php endif; ?>
		<!-- DOCS -->
		<?php if (!empty($docs)): ?>
			<article class="product-details__article product-details-tab" id="product-docs" data-tab>
				<h3 class="product-details-tab__title title-3">
					Документация
				</h3>

				<ul class="product-details-tab__docs product-details-docs">
					<?php foreach ($docs as $doc):
						$file = $doc['file'] ?? null;
						$file_title = $doc['title'] ?? '';
						$file_descr = $doc['descr'] ?? '';

						if (!$file || empty($file['url']))
							continue;

						$file_url = $file['url'];
						$file_size = !empty($file['filesize']) ? size_format($file['filesize']) : '';

						$file_type = '';
						if (!empty($file['filename'])) {
							$ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
							$file_type = strtoupper($ext);
						}

						if (empty($file_title) && !empty($file['filename'])) {
							$file_title = pathinfo($file['filename'], PATHINFO_FILENAME);
						}
						?>
						<li class="product-details-docs__item">
							<a class="product-details-docs__link link" href="<?php echo esc_url($file_url); ?>" target="_blank"
								rel="noopener" data-fancybox>
								<div class="product-details-docs__content">
									<?php if ($file_title): ?>
										<p class="product-details-docs__title">
											<?php echo esc_html($file_title); ?>
										</p>
									<?php endif; ?>

									<?php if ($file_descr): ?>
										<p class="product-details-docs__descr">
											<?php echo esc_html($file_descr); ?>
										</p>
									<?php endif; ?>
								</div>

								<div class="product-details-docs__meta">
									<?php if ($file_type): ?>
										<span class="product-details-docs__type">
											<?php echo esc_html($file_type); ?>
										</span>
									<?php endif; ?>

									<?php if ($file_size): ?>
										<span class="product-details-docs__size">
											<?php echo esc_html($file_size); ?>
										</span>
									<?php endif; ?>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</article>
		<?php endif; ?>

	</div>
</section>