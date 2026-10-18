<?php
$title = get_field('reviews_page_title') ?? 'Что говорят наши клиенты';
$args = [
	'post_type' => 'review',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
];

$query = new WP_Query($args);

if ($query->have_posts()): ?>
	<section class="section page-reviews" id="page-reviews">
		<div class="container page-reviews__container">
			<h2 class="page-reviews__title title-2">
				<?php echo esc_html($title) ?>
			</h2>
			<ul class="page-reviews__list grid">
				<?php while ($query->have_posts()):
					$query->the_post();
					$company = get_field('review_company') ?? ''; ?>
					<li class="page-reviews__item reviews-item">
						<div class="reviews-item__icon icon icon--review"></div>
						<div class="reviews-item__descr descr">
							<?php the_content() ?>
						</div>
						<div class="reviews-item__meta">
							<h3 class="reviews-item__author title-4">
								<?php the_title() ?>
							</h3>
							<?php if (!empty($company)): ?>
								<div class="reviews-item__company">
									<?php echo esc_html($company) ?>
								</div>
							<?php endif; ?>
						</div>

					</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>
		</div>
	</section>
<?php endif; ?>