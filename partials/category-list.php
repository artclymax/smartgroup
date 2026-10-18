<?php
$term = get_terms([
	'taxonomy' => 'product_cat',
	'hide_empty' => false,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'parent' => 0,
]);
?>
<?php if (!empty($term)): ?>
	<section class="section category-list" id="category-list">
		<div class="container category-list__container">
			<div class="category-list__wrapper">
				<ul class="category-list__list grid">
					<?php foreach ($term as $cat):
						$thumb_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
						$term_img = wp_get_attachment_url($thumb_id);
						?>
						<li class="category-list__item category-list-item">
							<a class="category-list-item__link" href="<?php echo esc_url(get_term_link($cat)); ?>">
								<div class="category-list-item__icon">
									<?php if (!empty($term_img)): ?>
										<img src="<?php echo esc_url($term_img); ?>" alt="<?php echo esc_html($cat->name); ?>">
									<?php else: ?>
										<img src="<?= esc_url(get_template_directory_uri() . '/assets/images/category-icon.svg'); ?>"
											alt="<?php echo esc_html($cat->name); ?>">
									<?php endif; ?>
								</div>
								<h4 class="category-list-item__text">
									<?php echo esc_html($cat->name); ?>
								</h4>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
<?php endif; ?>