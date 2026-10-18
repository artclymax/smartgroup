<?php
$page = 'option';

$title = get_field('cta_block_title') ?: get_field('cta_block_title', $page) ?? '';
$descr = get_field('cta_block_descr') ?: get_field('cta_block_descr', $page) ?? '';
$btn = get_field('cta_block_btn') ?: get_field('cta_block_btn', $page) ?? [];
$image = get_field('cta_block_image') ?: get_field('cta_block_image', $page) ?? null;
$image_mobile = get_field('cta_block_image_mobile') ?: get_field('cta_block_image_mobile', $page) ?? null;
?>

<?php if ($title || $descr || (!empty($btn) && !empty($btn['url'])) || ($image && !empty($image['ID']))): ?>
	<section class="section cta-block" id="cta-block">
		<div class="container cta-block__container">

			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>

			<?php if (!empty($btn) && !empty($btn['url'])): ?>
				<a class="cta-block__btn btn" href="<?php echo esc_url($btn['url']); ?>">
					<?php echo esc_html($btn['title']); ?>
				</a>
			<?php endif; ?>

		</div>

		<?php if (!empty($image) || !empty($image_mobile)): ?>
			<div class="cta-block__image image-box">
				<?php if (!empty($image)): ?>
					<?php echo wp_get_attachment_image(
						$image['ID'],
						'large',
						false,
						[
							'class' => 'img' . ($image_mobile && !empty($image_mobile['ID']) ? ' hidden-mobile' : ''),
							'alt' => $image['alt'] ?: $title,
							'loading' => 'lazy'
						]
					); ?>
				<?php endif; ?>
				<?php if (!empty($image_mobile)): ?>
					<?php echo wp_get_attachment_image(
						$image_mobile['ID'],
						'large',
						false,
						array(
							'class' => 'img visible-mobile',
							'alt' => $image_mobile['alt'] ?: ''
						)
					); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>