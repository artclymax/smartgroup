<?php
$title = get_field('hero_title') ?: get_the_title() ?: '';
$descr = get_field('hero_descr') ?? '';
$btn_first = get_field('hero_btn_first') ?? [];
$btn_second = get_field('hero_btn_second') ?? [];
$media = get_field('hero_media') ?? null;
$list = get_field('hero_list') ?? [];
?>

<?php if ($title || $descr || !empty($btn_first) || !empty($btn_second) || !empty($list) || ($media && !empty($media['ID']))): ?>
	<section class="hero" id="hero">
		<div class="container hero__container">

			<?php if ($title): ?>
				<h1 class="hero__title title-1">
					<?php echo wp_kses_post($title); ?>
				</h1>
			<?php endif; ?>

			<?php if ($descr): ?>
				<div class="hero__descr descr">
					<?php echo wp_kses_post($descr); ?>
				</div>
			<?php endif; ?>

			<?php if ((!empty($btn_first) && !empty($btn_first['url'])) || (!empty($btn_second) && !empty($btn_second['url']))): ?>
				<div class="hero__btn-box">
					<?php if (!empty($btn_first) && !empty($btn_first['url'])): ?>
						<a class="hero__btn btn" href="<?php echo esc_attr($btn_first['url']); ?>">
							<?php echo esc_html($btn_first['title']); ?>
						</a>
					<?php endif; ?>

					<?php if (!empty($btn_second) && !empty($btn_second['url'])): ?>
						<a class="hero__btn btn btn--light" href="<?php echo esc_attr($btn_second['url']); ?>">
							<?php echo esc_html($btn_second['title']); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($list)): ?>
				<div class="swiper hero-benefits-swiper"
					data-swiper='{ "slidesPerView": "auto", "spaceBetween": 20, "rewind": true }'>
					<div class="swiper-wrapper hero-benefits-swiper__wrapper">
						<?php foreach ($list as $item):
							$image = $item['image'] ?? null;
							$item_title = $item['title'] ?? '';
							$item_subtitle = $item['subtitle'] ?? '';
							$item_descr = $item['descr'] ?? '';
							?>
							<div class="swiper-slide hero-benefits-slide">
								<div class="hero-benefits-slide__wrapper">
									<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
										<div class="hero-benefits-slide__image">
											<?php echo wp_get_attachment_image(
												$image['ID'],
												'large',
												false,
												[
													'class' => 'img',
													'alt' => $image['alt'] ?: $item_title
												]
											); ?>
										</div>
									<?php endif; ?>

									<div class="hero-benefits-slide__content">
										<?php if ($item_title): ?>
											<h3 class="hero-benefits-slide__title">
												<span data-animation-counter>
													<?php echo esc_html($item_title); ?>
												</span>
												<?php if (!empty($item_subtitle)): ?>
													<span>
														<?php echo esc_html($item_subtitle); ?>
													</span>
												<?php endif; ?>
											</h3>
										<?php endif; ?>

										<?php if ($item_descr): ?>
											<div class="hero-benefits-slide__descr descr">
												<?php echo wp_kses_post($item_descr); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($media && is_array($media) && !empty($media['ID'])): ?>
			<div class="hero__media image-box">
				<?php
				$mime_type = get_post_mime_type($media['ID']);
				$is_video = strpos($mime_type, 'video') !== false;
				?>

				<?php if ($is_video): ?>
					<video src="<?php echo esc_url($args['video_url'] ?: wp_get_attachment_url($media['ID'])); ?>" autoplay muted
						loop playsinline></video>
				<?php else: ?>
					<?php echo wp_get_attachment_image(
						$media['ID'],
						'large',
						false,
						[
							'class' => 'img',
							'alt' => $media['alt'] ?: $title,
							'fetchpriority' => 'high'
						]
					); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>