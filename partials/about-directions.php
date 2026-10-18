<?php
$page = get_queried_object();

$label = get_field('about_directions_label', $page) ?? '';
$title = get_field('about_directions_title', $page) ?? '';
$list = get_field('about_directions_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section about-directions" id="about-directions">
		<div class="container about-directions__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="about-directions__cards grid">
					<?php foreach ($list as $item):
						$bg_image = $item['image'] ?? null;
						$icon = $item['icon'] ?? null;
						$item_title = $item['title'] ?? '';
						$item_descr = $item['descr'] ?? '';
						$category = $item['category'] ?? null;
						$url = '#';
						if ($category) {
							$url = get_term_link($category);
						}
						?>
						<li class="about-directions__card about-directions-card">
							<a class="about-directions-card__link" href="<?php echo esc_attr($url) ?>">

								<?php if ($bg_image && is_array($bg_image) && !empty($bg_image['ID'])): ?>
									<div class="about-directions-card__image image-box">
										<?php echo wp_get_attachment_image(
											$bg_image['ID'],
											'medium_large',
											false,
											[
												'class' => 'img',
												'alt' => $bg_image['alt'] ?: $item_title,
												'loading' => 'lazy'
											]
										); ?>
									</div>
								<?php endif; ?>

								<div class="about-directions-card__content">
									<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
										<div class="about-directions-card__icon">
											<?php echo wp_get_attachment_image(
												$icon['ID'],
												'full',
												false,
												[
													'class' => 'img',
													'alt' => $icon['alt'] ?: $item_title,
													'loading' => 'lazy'
												]
											); ?>
										</div>
									<?php endif; ?>

									<?php if ($item_title): ?>
										<h3 class="about-directions-card__title title-4">
											<?php echo esc_html($item_title); ?>
										</h3>
									<?php endif; ?>

									<?php if ($item_descr): ?>
										<div class="about-directions-card__descr descr">
											<?php echo wp_kses_post($item_descr); ?>
										</div>
									<?php endif; ?>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>