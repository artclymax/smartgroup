<?php
$page = get_queried_object();

$title = get_field('about_why_us_title', $page) ?? '';
$list = get_field('about_why_us_list', $page) ?? [];
$image = get_field('about_why_us_image', $page) ?? null;
?>

<?php if ($title || !empty($list) || ($image && !empty($image['ID']))): ?>
	<section class="section about-why-us" id="about-why-us">
		<div class="container about-why-us__container">

			<?php if ($title): ?>
				<h2 class="about-why-us__title title-1">
					<?php echo esc_html($title); ?>
				</h2>
			<?php endif; ?>

			<?php if (!empty($list)): ?>
				<ul class="about-why-us__list grid">
					<?php foreach ($list as $item):
						$icon = $item['icon'] ?? null;
						$item_title = $item['title'] ?? '';
						?>
						<li class="about-why-us__item about-why-us-item">
							<?php if ($icon && is_array($icon) && !empty($icon['ID'])): ?>
								<div class="about-why-us-item__icon">
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

							<?php if ($item_title): ?>
								<h3 class="about-why-us-item__title title-4">
									<?php echo esc_html($item_title); ?>
								</h3>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>

		<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
			<div class="about-why-us__image image-box">
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

	</section>
<?php endif; ?>