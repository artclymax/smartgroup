<?php
$page = get_queried_object();

$label = get_field('suppliers_why_us_label', $page) ?? '';
$title = get_field('suppliers_why_us_title', $page) ?? '';
$list = get_field('suppliers_why_us_list', $page) ?? [];
$note = get_field('suppliers_why_us_note', $page) ?? '';
?>

<?php if ($label || $title || !empty($list) || $note): ?>
	<section class="section suppliers-why-us" id="suppliers-why-us">
		<div class="container suppliers-why-us__container">

			<?php get_template_part('partials/section-header', null, [
				'class' => 'section-header--two',
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="suppliers-why-us__list grid">
					<?php foreach ($list as $item):
						$icon = $item['image'] ?? null;
						$item_title = $item['title'] ?? '';
						?>
						<li class="suppliers-why-us__item suppliers-why-us-item">

							<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
								<div class="suppliers-why-us-item__icon">
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
								<h3 class="suppliers-why-us-item__title title-4">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>

						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ($note): ?>
				<div class="suppliers-why-us__note title-3 descr">
					<?php echo wp_kses_post($note); ?>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>