<?php
$page = 'option';
$modals = get_field('modals', $page) ?? [];
?>

<?php if ($modals): ?>
	<?php foreach ($modals as $item):
		// Санитизация ID: только латиница, цифры, дефис, нижнее подчёркивание
		$raw_id = $item['id'] ?? '';
		$id = preg_replace('/[^a-z0-9\-_]/i', '', sanitize_title($raw_id));

		// Пропускаем итерацию, если после очистки ID пустой
		if (empty($id))
			continue;

		$title = $item['title'] ?? '';
		$descr = $item['descr'] ?? '';
		$shortcode = $item['shortcode'] ?? '';
		$image = $item['image'] ?? '';
		?>

		<!-- OVERLAY -->
		<div class="modal modal-<?= esc_attr($id) ?>" id="<?= esc_attr($id) ?>" data-modal>
			<!-- MODAL -->
			<div class="modal__box modal-call__box" data-modal-box>
				<!-- CLOSE-BTN -->
				<button class="modal__close-btn modal-close-btn" data-modal-close aria-label="Закрыть модальное окно"
					type="button">
					<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13 13L22 22M13 13L4 4M13 13L4 22M13 13L22 4" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" />
					</svg>
				</button>
				<!-- BODY -->
				<div class="modal__body">
					<div class="modal__wrapper">
						<?php if (!empty($image)): ?>
							<div class="modal__image image-box hidden-mobile">
								<?php echo wp_get_attachment_image(
									$image['ID'],
									'large',
									false,
									[
										'class' => 'img',
									]
								); ?>
							</div>
						<?php endif; ?>
						<div class="modal__form-box form-box">
							<?php if ($title): ?>
								<h3 class="form-box__title title-3">
									<?php echo esc_html($title); ?>
								</h3>
							<?php endif; ?>
							<?php if ($descr): ?>
								<div class="modal__descr modal__descr descr" id="<?= esc_attr($id) ?>-desc">
									<?php echo wp_kses_post($descr) ?>
								</div>
							<?php endif; ?>
							<?php if ($shortcode): ?>
								<div class="form-box__form modal__form">
									<?php echo do_shortcode($shortcode) ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>