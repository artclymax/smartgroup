<?php
$page = get_queried_object();
$list = get_field('services_grid_list', $page) ?? [];
?>

<?php if (!empty($list)): ?>
	<section class="services" id="services">
		<div class="container services__container">
			<ul class="services__list grid">
				<?php foreach ($list as $item):
					$image = $item['image'] ?? null;
					$title = $item['title'] ?? '';
					$category = $item['category'] ?? null;

					$url = '#';
					$final_title = $title;

					if ($category && !is_wp_error($category)) {
						$url = get_term_link($category); 
						if (empty($final_title)) {
							$final_title = $category->name;
						}
					}
					?>
					<li class="services__item services-item">
						<a class="services-item__link" href="<?php echo esc_url($url); ?>">

							<?php if ($image && is_array($image) && !empty($image['ID'])): ?>
								<div class="services-item__image image-box">
									<?php echo wp_get_attachment_image(
										$image['ID'],
										'medium_large',
										false,
										[
											'class' => 'img',
											'alt' => $image['alt'] ?: $final_title,
											'loading' => 'lazy'
										]
									); ?>
								</div>
							<?php endif; ?>

							<div class="services-item__content">
								<?php if ($final_title): ?>
									<h3 class="services-item__title">
										<?php echo esc_html($final_title); ?>
									</h3>
								<?php endif; ?>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>