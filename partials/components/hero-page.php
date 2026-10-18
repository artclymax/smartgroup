<?php
$title = get_field('hero_title') ?: get_the_title() ?: '';
$descr = get_field('hero_descr') ?? '';
$btn = get_field('hero_btn') ?? '';
$image = get_field('hero_image') ?? '';
if (is_archive()) {
	$archive_name = get_queried_object()->name ?: get_queried_object()->has_archive;
	$page = get_page_by_path($archive_name, OBJECT, 'page');
	$title = get_field('hero_title', $page) ?: get_the_archive_title() ?: get_the_title() ?: '';
	$descr = get_field('hero_descr', $page) ?? '';
	$btn = get_field('hero_btn', $page) ?? '';
	$image = get_field('hero_image', $page) ?? '';
}
?>
<section class="hero-page" id="hero-page">
	<div class="container hero-page__container">
		<div class="hero-page__breadcrumbs page-breadcrumbs">
			<?php woocommerce_breadcrumb(['delimiter' => '']); ?>
		</div>
		<div class="hero-page__content">
			<h1 class="hero-page__title title-1">
				<?php echo wp_kses_post($title) ?>
			</h1>
			<?php if (!empty($descr)): ?>
				<div class="hero-page__descr descr">
					<?php echo wp_kses_post($descr) ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($btn) && !empty($btn['url'])): ?>
				<a class="hero-page__btn btn" href="<?php echo esc_url($btn['url']); ?>">
					<?php echo esc_html($btn['title']); ?>
				</a>
			<?php endif; ?>
		</div>

	</div>
	<?php if (!empty($image)): ?>
		<div class="hero-page__image image-box">
			<?php echo wp_get_attachment_image(
				$image['ID'],
				'large',
				false,
				array(
					'class' => 'img',
					'alt' => $image['alt'] ?: ''
				)
			); ?>
		</div>
	<?php endif; ?>
</section>