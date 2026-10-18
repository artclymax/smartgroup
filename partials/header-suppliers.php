<?php
$page = get_queried_object(); // Или get_page_by_path('suppliers', OBJECT, 'page')

$title = get_field('hero_title', $page) ?? '';
$descr = get_field('hero_descr', $page) ?? '';
$btn = get_field('hero_btn', $page) ?? [];
$image = get_field('hero_image', $page) ?? null;
$image_mobile = get_field('suppliers_header_image_mobile', $page) ?? null;
?>

<header class="header-suppliers" id="header-suppliers">
	<div class="container header-suppliers__container">

		<div class="header-suppliers__top">
			<div class="header-suppliers__logo logo">
				<?php mx_logo(); ?>
			</div>
		</div>

		<div class="header-suppliers__body">
			<?php if ($title): ?>
				<h1 class="header-suppliers__title title-2">
					<?php echo esc_html($title); ?>
				</h1>
			<?php endif; ?>

			<?php if ($descr): ?>
				<div class="header-suppliers__descr descr">
					<?php echo wp_kses_post($descr); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($btn) && !empty($btn['url'])): ?>
				<a class="header-suppliers__btn btn" href="<?php echo esc_url($btn['url']); ?>">
					<?php echo esc_html($btn['title']); ?>
				</a>
			<?php endif; ?>
		</div>

	</div>

	<?php if (($image && !empty($image['ID'])) || ($image_mobile && !empty($image_mobile['ID']))): ?>
		<div class="header-suppliers__image image-box">

			<?php if ($image && !empty($image['ID'])): ?>
				<?php echo wp_get_attachment_image(
					$image['ID'],
					'large',
					false,
					[
						'class' => 'img' . (!empty($image_mobile['ID']) ? ' hidden-mobile' : ''),
						'alt' => $image['alt'] ?: $title
					]
				); ?>
			<?php endif; ?>

			<?php if ($image_mobile && !empty($image_mobile['ID'])): ?>
				<?php echo wp_get_attachment_image(
					$image_mobile['ID'],
					'large',
					false,
					[
						'class' => 'img visible-mobile',
						'alt' => $image_mobile['alt'] ?: $title
					]
				); ?>
			<?php endif; ?>

		</div>
	<?php endif; ?>

</header>