<?php
$page = get_page_by_path('home', OBJECT, 'page');

// Чистая логика фоллбэка: сначала ищем на главной, если нет — на текущей странице
$label = get_field('contacts_form_label', $page) ?: get_field('contacts_form_label') ?? '';
$title = get_field('contacts_form_title', $page) ?: get_field('contacts_form_title') ?? '';
$descr = get_field('contacts_form_descr', $page) ?: get_field('contacts_form_descr') ?? '';
$form_title = get_field('contacts_form_form_title', $page) ?: get_field('contacts_form_form_title') ?? ''; // 👈 Исправлено: отдельное поле
$form = get_field('contacts_form_shortcode', $page) ?: get_field('contacts_form_shortcode') ?? '';   // 👈 Исправлено: более понятное имя
?>

<?php if ($label || $title || $descr || $form_title || $form): ?>
	<section class="section contacts-form" id="contacts-form">
		<div class="container contacts-form__container">

			<div class="contacts-form__content">
				<?php get_template_part('partials/section-header', null, [
					'label' => $label,
					'title' => $title,
					'descr' => $descr
				]); ?>

				<?php get_template_part('partials/contacts-box'); ?>
			</div>

			<?php if ($form): ?>
				<div class="contacts-form__form-box form-box">
					<?php if ($form_title): ?>
						<h3 class="form-box__title title-3">
							<?php echo esc_html($form_title); ?>
						</h3>
					<?php endif; ?>

					<div class="form-box__form">
						<?php echo do_shortcode($form); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>