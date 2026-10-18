<?php
$page = get_page_by_path( 'news', OBJECT, 'page' );
$label = get_field('page_news_label') ?: get_field('page_news_label', $page) ?? '';
$title = get_field('page_news_title') ?: get_field('page_news_title', $page) ?? '';


if (have_posts()): ?>

	<section class="section page-news" id="page-news">
		<div class="container page-news__container">
			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title
			]); ?>
			<ul class="page-news__list grid">
				<?php while (have_posts()):
					the_post(); ?>
					<li class="page-news__item featured-news-item news-item">
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
				<?php endwhile; ?>
			</ul>
			<!-- ПАГИНАЦИЯ -->
			<nav class="page-news__pagination pagination-page">
				<?php mx_pagination($wp_query, 'Предыдущая', 'Следующая') ?>
			</nav>
		</div>
	</section>
<?php endif; ?>