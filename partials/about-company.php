<?php
$page = get_queried_object();

$label = get_field('about_company_label', $page) ?? '';
$title = get_field('about_company_title', $page) ?? '';
$descr = get_field('about_company_descr', $page) ?? '';
$btn = get_field('about_company_btn', $page) ?? [];
$image = get_field('about_company_image', $page) ?? null;
$cards = get_field('about_company_cards', $page) ?? [];
?>

<?php if ($label || $title || $descr || ($image && !empty($image['ID'])) || !empty($cards)): ?>
	<section class="section about-company" id="about-company">

		<!-- Верхний блок: изображение + контент -->
		<div class="un-container about-company__container">

			<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
				<div class="un-container__full about-company__image image-box">
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

			<div class="un-container__content about-company__content">
				<?php get_template_part('partials/section-header', null, [
					'label' => $label,
					'title' => $title,
					'descr' => $descr
				]); ?>

				<?php if (!empty($btn) && !empty($btn['url'])): ?>
					<a class="about-company__btn btn btn--stroke" href="<?php echo esc_url($btn['url']); ?>">
						<?php echo esc_html($btn['title']); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<!-- Нижний блок: карточки -->
		<?php if (!empty($cards)): ?>
			<div class="container about-company__container">
				<ul class="about-company__cards grid">
					<?php foreach ($cards as $card):
						$icon = $card['icon'] ?? null;
						$card_title = $card['title'] ?? '';
						?>
						<li class="about-company__card about-company-card">
							<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
								<div class="about-company-card__icon">
									<?php echo wp_get_attachment_image(
										$icon['ID'],
										'full',
										false,
										[
											'class' => 'img',
											'alt' => $icon['alt'] ?: $card_title,
											'loading' => 'lazy'
										]
									); ?>
								</div>
							<?php endif; ?>

							<?php if ($card_title): ?>
								<h3 class="about-company-card__title title-4">
									<?php echo esc_html($card_title); ?>
								</h3>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

	</section>
<?php endif; ?>