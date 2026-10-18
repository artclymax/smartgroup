<?php
$page = get_queried_object();
$label = get_field('about_label', $page) ?? '';
$title = get_field('about_title', $page) ?? '';
$descr = get_field('about_descr', $page) ?? '';
$list = get_field('about_list', $page) ?? [];
$btn = get_field('about_btn', $page) ?? [];
?>

<?php if ($label || $title || $descr || !empty($list) || (!empty($btn) && !empty($btn['url']))): ?>
	<section class="section about" id="about">
		<div class="container about__container">

			<div class="about__header-block">
				<?php get_template_part('partials/section-header', null, [
					'label' => $label,
					'title' => $title,
					'descr' => $descr
				]); ?>

				<?php if (!empty($btn) && !empty($btn['url'])): ?>
					<a class="about__btn btn btn--light hidden-mobile" href="<?php echo esc_url($btn['url']); ?>">
						<?php echo esc_html($btn['title']); ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="about__list-block">
				<?php if (!empty($list)): ?>
					<ul class="about__list grid">
						<?php foreach ($list as $item):
							$icon = $item['icon'] ?? null;
							$item_title = $item['title'] ?? '';
							$item_descr = $item['descr'] ?? '';
							?>
							<li class="about__item about-item">
								<div class="about-item__header">
									<div class="about-item__icon-box">
										<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
											<div class="about-item__icon">
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
										<h3 class="about-item__title title-4">
											<?php echo esc_html($item_title); ?>
										</h3>
									<?php endif; ?>
								</div>

								<?php if ($item_descr): ?>
									<div class="about-item__descr descr">
										<?php echo wp_kses_post($item_descr); ?>
									</div>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if (!empty($btn) && !empty($btn['url'])): ?>
					<a class="about__btn btn btn--stroke visible-mobile" href="<?php echo esc_url($btn['url']); ?>">
						<?php echo esc_html($btn['title']); ?>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</section>
<?php endif; ?>