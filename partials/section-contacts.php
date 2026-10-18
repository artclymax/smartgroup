<section class="section-full section-contacts" id="section-contacts">
	<div class="container section-contacts__container">
		<div class="section-contacts__content">
			<h2 class="section-contacts__title title-3">Контакты</h2>
			<?php get_template_part('partials/contacts-box') ?>
		</div>
		<?php if (!empty($map = get_field('contacts_map', 'option'))): ?>
			<div class="section-contacts__map">
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
		<?php endif; ?>
	</div>
</section>