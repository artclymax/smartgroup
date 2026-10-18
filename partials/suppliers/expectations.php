<?php
$page = get_queried_object(); // Или get_page_by_path('suppliers', OBJECT, 'page')

$label = get_field('suppliers_expectations_label', $page) ?? '';
$title = get_field('suppliers_expectations_title', $page) ?? '';
$list = get_field('suppliers_expectations_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section suppliers-expectations" id="suppliers-expectations">
		<div class="container suppliers-expectations__container">

			<?php get_template_part('partials/section-header', null, [
				'class' => 'section-header--two', // 👈 Сохранена особенность секции
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="expectation__list grid">
					<?php foreach ($list as $item):
						$icon = $item['image'] ?? null;
						$item_title = $item['title'] ?? '';

						if (!$item_title)
							continue; // Пропускаем пункты без заголовка
						?>
						<li class="expectation__item expectation-item">

							<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
								<div class="expectation-item__icon">
									<?php echo wp_get_attachment_image(
										$icon['ID'],
										'large',
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
								<h3 class="expectation-item__title">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>

						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>