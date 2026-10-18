<?php
$page = get_queried_object();

$label = get_field('services_about_label', $page) ?? '';
$title = get_field('services_about_title', $page) ?? '';
$descr = get_field('services_about_descr', $page) ?? '';
?>

<?php if ($label || $title || $descr): ?>
	<section class="section services-about" id="services-about">
		<div class="container services-about__container">
			<?php get_template_part('partials/section-header', null, [
				'label' => $label,
				'title' => $title,
				'descr' => $descr
			]); ?>
		</div>
	</section>
<?php endif; ?>