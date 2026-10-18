<?php
$page = get_queried_object();

$label = get_field('services_directions_label', $page) ?? '';
$title = get_field('services_directions_title', $page) ?? '';
$list = get_field('services_directions_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section services-directions" id="services-directions">
		<div class="container services-directions__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="services-directions__list grid">
					<?php foreach ($list as $index => $item):
						$icon = $item['icon'] ?? null;
						$item_title = $item['title'] ?? '';
						$item_descr = $item['descr'] ?? '';

						$number = $index++ > 9 ? $index : '0' . $index;
						?>
						<li class="services-directions__item services-directions-item">

							<div class="services-directions-item__header">
								<div class="services-directions-item__number title-1">
									<?php echo esc_html($number); ?>
								</div>

								<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
									<div class="services-directions-item__icon">
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
							</div>

							<?php if ($item_title): ?>
								<h3 class="services-directions-item__title">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>

							<?php if ($item_descr): ?>
								<div class="services-directions-item__descr descr">
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