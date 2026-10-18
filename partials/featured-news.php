<?php
$page = get_page_by_path( 'news', OBJECT, 'page' );
$label = get_field('featured_news_label') ?: get_field('featured_news_label', $page) ?? '';
$title = get_field('featured_news_title') ?: get_field('featured_news_title', $page) ?? '';

$args = [
	'post_type' => 'news',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish',
	'tax_query' => [
		[
			'taxonomy' => 'news_category',
			'field' => 'slug',
			'terms' => 'featured',
		]
	]
];

$query = new WP_Query($args);

if ($query->have_posts()): ?>
	<section class="section featured-news" id="featured-news">
		<div class="container featured-news__container">
			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>
			<ul class="featured-news__list">
				<?php while ($query->have_posts()):
					$query->the_post();
					?>
					<li class="featured-news__item featured-news-item">
						<a class="featured-news-item__link" href="<?php the_permalink() ?>">
							<div class="featured-news-item__image image-box">
								<?php echo get_the_post_thumbnail(); ?>
							</div>
							<div class="featured-news-item__content">
								<div class="featured-news-item__wrapper">
									<time class="featured-news-item__time"
										datetime="<?= esc_attr(get_the_date('Y-m-d')) ?>"><?= esc_html(get_the_date('j F Y')) ?></time>
									<h2 class="featured-news-item__title title-4">
										<?php the_title() ?>
									</h2>
									<div class="featured-news-item__descr descr">
										<?php the_excerpt() ?>
									</div>
								</div>
								<span class="featured-news-item__btn btn btn--stroke">Подробнее</span>
							</div>
						</a>
					</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>
		
		</div>
	</section>
<?php endif; ?>