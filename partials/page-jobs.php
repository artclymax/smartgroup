<?php
$page = get_queried_object();
$section_title = get_field('jobs_section_title', $page) ?: 'Открытые позиции';
$form_title = get_field('jobs_form_title', $page) ?: 'Отправить отклик';
$form_shortcode = get_field('jobs_form_shortcode', $page) ?? '';

$jobs_query = new WP_Query([
	'post_type' => 'job',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'orderby' => 'menu_order',
	'order' => 'ASC',
]);
?>

<?php if ($jobs_query->have_posts()): ?>
	<section class="section-full page-jobs" id="page-jobs">
		<div class="container page-jobs__container">

			<?php if ($section_title): ?>
				<h2 class="page-jobs__title title-2">
					<?php echo esc_html($section_title); ?>
				</h2>
			<?php endif; ?>

			<ul class="page-jobs__list">
				<?php while ($jobs_query->have_posts()):
					$jobs_query->the_post();
					$job_title = get_the_title();
					$job_location = get_field('job_location') ?? '';
					$job_descr = apply_filters('the_content', get_the_content());
					?>
					<li class="page-jobs__item page-jobs-item">

						<div class="page-jobs-item__header">
							<h3 class="page-jobs-item__title title-4">
								<?php echo esc_html($job_title); ?>
							</h3>

							<?php if ($job_location): ?>
								<p class="page-jobs-item__location">
									<?php echo esc_html($job_location); ?>
								</p>
							<?php endif; ?>
						</div>

						<?php if ($job_descr): ?>
							<div class="page-jobs-item__descr descr">
								<?php echo wp_kses_post($job_descr); ?>
							</div>
						<?php endif; ?>

						<a class="page-jobs-item__btn btn" href="#jobs-form" data-jobs-btn="<?php echo esc_attr($job_title); ?>">
							Откликнуться
						</a>
					</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>

			<?php if ($form_shortcode): ?>
				<div class="page-jobs__form-box" id="jobs-form">
					<?php if ($form_title): ?>
						<h2 class="page-jobs__form-title title-3">
							<?php echo esc_html($form_title); ?>
						</h2>
					<?php endif; ?>

					<div class="page-jobs__form">
						<?php echo do_shortcode($form_shortcode); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>