<?php
global $product;

$btn = get_field('product_btn') ?? [];

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
?>

<section id="product-<?php echo esc_attr($product->get_id()); ?>" <?php echo wc_product_class('section product-hero', $product); ?>>
	<div class="container product-hero__container">

		<div class="product-hero__breadcrumbs page-breadcrumbs">
			<?php woocommerce_breadcrumb(['delimiter' => '']); ?>
		</div>

		<div class="product-hero__wrapper">

			<!-- CONTENT -->
			<div class="product-hero__content">
				<h1 class="product-hero__title title-1">
					<?php the_title(); ?>
				</h1>
				<div class="product-hero__descr descr">
					<?php the_content(); ?>
				</div>

				<?php if (!empty($btn) && !empty($btn['url'])): ?>
					<a class="product-hero__btn btn" href="<?php echo esc_url($btn['url']); ?>">
						<?php echo esc_html($btn['title']); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- MEDIA -->
			<div class="product-hero__media">

				<!-- MAIN SWIPER -->
				<div class="swiper product-hero-swiper">
					<div class="swiper-wrapper product-hero-swiper__wrapper">

						<!-- Миниатюра товара -->
						<?php if ($thumbnail_id): ?>
							<div class="swiper-slide product-hero-slide">
								<a class="product-hero-slide__wrapper-link image-box"
									href="<?php echo esc_url(wp_get_attachment_image_url($thumbnail_id, 'full')); ?>"
									data-fancybox="product-hero-gallery">
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
								<div class="swiper-slide product-hero-slide">
									<a class="product-hero-slide__wrapper-link image-box" href="<?php echo esc_url($photo['url']); ?>"
										data-fancybox="product-hero-gallery">
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
								<div class="swiper-slide product-hero-slide">
									<a class="product-hero-slide__wrapper image-box slide-video"
										href="<?php echo esc_url($file['url']); ?>" data-fancybox="product-hero-gallery">
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
											<div class="product-hero-slide__video-icon"></div>
										<?php endif; ?>
									</a>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

					</div>
				</div>

				<!-- THUMB SWIPER -->
				<div class="swiper product-hero-swiper-thumb">
					<div class="swiper-wrapper product-hero-swiper-thumb__wrapper">

						<!-- Миниатюра товара -->
						<?php if ($thumbnail_id): ?>
							<div class="swiper-slide product-hero-slide-thumb">
								<div class="product-hero-slide-thumb__wrapper image-box">
									<?php echo wp_get_attachment_image(
										$thumbnail_id,
										'thumbnail',
										false,
										[
											'class' => 'img',
											'alt' => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: $product->get_name()
										]
									); ?>
								</div>
							</div>
						<?php endif; ?>

						<!-- Изображения из галереи -->
						<?php if (!empty($gallery)): ?>
							<?php foreach ($gallery as $photo): ?>
								<div class="swiper-slide product-hero-slide-thumb">
									<div class="product-hero-slide-thumb__wrapper image-box">
										<?php echo wp_get_attachment_image(
											$photo['ID'],
											'thumbnail',
											false,
											[
												'class' => 'img',
												'alt' => $photo['alt']
											]
										); ?>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

						<!-- Видео (миниатюры) -->
						<?php if (!empty($videos)): ?>
							<?php foreach ($videos as $video):
								$cover = $video['cover'] ?? null;
								?>
								<div class="swiper-slide product-hero-slide-thumb">
									<div
										class="product-hero-slide-thumb__wrapper product-hero-slide-thumb__wrapper image-box slide-video">
										<?php if ($cover && !empty($cover['ID'])): ?>
											<?php echo wp_get_attachment_image(
												$cover['ID'],
												'thumbnail',
												false,
												[
													'class' => 'img',
													'alt' => $video['title'] ?? 'Видео'
												]
											); ?>
										<?php else: ?>
											<div class="product-hero-slide-thumb__video-icon"></div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

					</div>
				</div>

				<!-- SWIPER-BTNS -->
				<div class="swiper-btn-box visible-mobile">
					<button class="swiper-btn swiper-btn__prev product-hero-swiper__btn product-hero-swiper__btn-prev"
						type="button" aria-label="Назад" data-swiper-btn-prev=".product-hero-swiper"></button>
					<button class="swiper-btn swiper-btn__next product-hero-swiper__btn product-hero-swiper__btn-next"
						type="button" aria-label="Вперёд" data-swiper-btn-next=".product-hero-swiper"></button>
				</div>

			</div>
		</div>
	</div>
</section>