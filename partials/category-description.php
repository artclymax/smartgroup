<?php
$term = get_queried_object();


$title = get_field('category_description_title', $term) ?: 'Описание решения';
$descr = get_field('category_description_descr', $term) ?? '';
$image = get_field('category_description_image', $term) ?? null;
$list = get_field('category_description_list', $term) ?? [];
?>

<?php if (!empty($descr) || !empty($list)): ?>
	<section class="section-full category-description" id="category-description">
		<div class="container category-description__container">
			<div class="category-description__top">
				<div class="category-description__content">
					<?php if ($title): ?>
						<h2 class="category-description__title title-2">
							<?php echo esc_html($title); ?>
						</h2>
					<?php endif; ?>

					<?php if ($descr): ?>
						<div class="category-description__wrapper" data-hidden-descr-content>
							<div class="category-description__descr descr" data-hidden-descr-wrapper>
								<?php echo wp_kses_post($descr); ?>
							</div>
							<button class="category-description__btn" type="button" data-hidden-descr-btn>
								Подробнее
							</button>
						</div>
					<?php endif; ?>
				</div>

				<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
					<div class="category-description__image image-box">
						<?php echo wp_get_attachment_image(
							$image['ID'],
							'large',
							false,
							[
								'class' => 'img',
								'alt' => $image['alt'] ?: $title,
								'loading' => 'lazy'
							]
						); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($list)): ?>
				<ul class="category-description__list grid">
					<?php foreach ($list as $item):
						$item_image = $item['image'] ?? null;
						$item_title = $item['title'] ?? '';
						$item_descr = $item['descr'] ?? '';
						?>
						<li class="category-description__item category-description-item">

							<?php if ($item_image && is_array($item_image) && !empty($item_image['ID'])): ?>
								<div class="category-description-item__icon">
									<?php echo wp_get_attachment_image(
										$item_image['ID'],
										'full',
										false,
										[
											'class' => 'img',
											'alt' => $item_image['alt'] ?: $item_title,
											'loading' => 'lazy'
										]
									); ?>
								</div>
							<?php endif; ?>

							<?php if ($item_title): ?>
								<h3 class="category-description-item__title title-4">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>

							<?php if ($item_descr): ?>
								<div class="category-description-item__descr descr">
									<?php echo wp_kses_post($item_descr); ?> 
								</div>
							<?php endif; ?>

						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>