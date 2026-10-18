<?php
$page = get_queried_object(); // Или get_page_by_path('home', OBJECT, 'page')

$label = get_field('services_benefits_label', $page) ?? '';
$title = get_field('services_benefits_title', $page) ?? '';
$list = get_field('services_benefits_list', $page) ?? [];
?>

<?php if ($label || $title || !empty($list)): ?>
	<section class="section services-benefits" id="services-benefits">
		<div class="container services-benefits__container">

			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>

			<?php if (!empty($list)): ?>
				<ul class="services-benefits__list">
					<?php foreach ($list as $item):
						$item_title = $item['title'] ?? '';
						$item_descr = $item['descr'] ?? '';

						if (!$item_title && !$item_descr)
							continue;
						?>
						<li class="services-benefits__item services-benefits-item">

							<?php if ($item_title): ?>
								<h3 class="services-benefits-item__title">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>

							<?php if ($item_descr): ?>
								<div class="services-benefits-item__descr descr">
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