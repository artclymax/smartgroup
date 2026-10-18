<?php
$page = 'option';

$form = get_field('contacts_page_form') ?? '';
$form_title = get_field('contacts_page_form_title') ?? 'Оставить заявку';
$map = get_field('contacts_map', $page) ?? '';
$map_title = get_field('contacts_page_map_title') ?? 'Где мы находимся';
?>
<section class="section-full page-contacts" id="page-contacts">
	<div class="container page-contacts__container">
		<div class="page-contacts__wrapper">
			<div class="page-contacts__contacts box-contacts">
				<?php get_template_part('partials/contacts-box', null, ['show_messengers' => true]); ?>
			</div>
			<?php if (!empty($form)): ?>
				<div class="page-contacts__form-block box-contacts">
					<h3 class="page-contacts__title title-3">
						<?php echo esc_html($form_title) ?>
					</h3>
					<div class="page-contacts__form">
						<?php echo do_shortcode($form); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if (!empty($map)): ?>
			<div class="page-contacts__map-box">
				<h3 class="page-contacts__map-title title-2">
					<?php echo esc_html($map_title) ?>
				</h3>
				<div class="page-contacts__map box-contacts">
					<?php echo wp_kses($map, [
						'iframe' => [
							'src' => true,
							'width' => true,
							'height' => true,
							'style' => true,
							'allowfullscreen' => true,
							'loading' => true,
						],
					]) ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>