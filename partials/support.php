<?php
$page = get_queried_object();

$label = get_field('support_label', $page) ?? '';
$title = get_field('support_title', $page) ?? '';
$descr = get_field('support_descr', $page) ?? '';
$list = get_field('support_list', $page) ?? [];
$btn = get_field('support_btn', $page) ?? [];
$cards = get_field('support_cards', $page) ?? [];
$bg_big = get_field('support_bg_big', $page) ?? null;
$bg_small = get_field('support_bg_small', $page) ?? null;
?>

<?php if ($label || $title || $descr || !empty($list) || !empty($cards) || ($bg_big && !empty($bg_big['ID'])) || ($bg_small && !empty($bg_small['ID']))): ?>
	<section class="section support" id="support">
		<div class="container support__container">

			<div class="support__info">
				<?php get_template_part('partials/section-header', null, [
					'label' => $label,
					'title' => $title,
					'descr' => $descr
				]); ?>

				<?php if (!empty($list) || (!empty($btn) && !empty($btn['url']))): ?>
					<div class="support__list-box">
						<?php if (!empty($list)): ?>
							<ul class="support__list">
								<?php foreach ($list as $item):
									$item_descr = $item['descr'] ?? '';
									if (!$item_descr)
										continue;
									?>
									<li class="support__item icon icon--checkmark">
										<?php echo esc_html($item_descr); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<?php if (!empty($btn) && !empty($btn['url'])): ?>
							<a class="support__btn btn" href="<?php echo esc_url($btn['url']); ?>">
								<?php echo esc_html($btn['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($cards)): ?>
				<ul class="support__cards grid">
					<?php foreach ($cards as $card):
						$icon = $card['icon'] ?? null;
						$card_title = $card['title'] ?? '';
						$card_descr = $card['descr'] ?? '';
						?>
						<li class="support__card support-card">
							<div class="support-card__header">
								<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
									<div class="about-item__icon-box support-card__icon-box">
										<div class="about-item__icon support-card__icon">
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
									</div>
								<?php endif; ?>

								<?php if ($card_title): ?>
									<h3 class="support-card__title">
										<?php echo esc_html($card_title); ?>
									</h3>
								<?php endif; ?>
							</div>

							<?php if ($card_descr): ?>
								<div class="support-card__descr descr">
									<?php echo wp_kses_post($card_descr); ?>
								</div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>

		<?php if (($bg_big && !empty($bg_big['ID'])) || ($bg_small && !empty($bg_small['ID']))): ?>
			<div class="support__bg-box image-box">
				<?php if ($bg_big && !empty($bg_big['ID'])): ?>
					<?php echo wp_get_attachment_image(
						$bg_big['ID'],
						'full',
						false,
						[
							'class' => 'support__bg-big hidden-mobile img',
							'alt' => $bg_big['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				<?php endif; ?>

				<?php if ($bg_small && !empty($bg_small['ID'])): ?>
					<?php echo wp_get_attachment_image(
						$bg_small['ID'],
						'full',
						false,
						[
							'class' => 'support__bg-small visible-mobile img',
							'alt' => $bg_small['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</section>
<?php endif; ?>