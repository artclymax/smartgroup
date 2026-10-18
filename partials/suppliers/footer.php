<?php
$label = get_field('suppliers_footer_label') ?? '';
$title = get_field('suppliers_footer_title') ?? '';
?>
<footer class="section suppliers-footer" id="suppliers-footer">
	<div class="container suppliers-footer__container">
		<?php get_template_part('partials/section-header', null, [
			'label' => $label,
			'title' => $title,
		]); ?>
		<div class="suppliers-footer__contacts">
			<?php get_template_part('partials/contacts-box', null, [
				'show_address' => false,
				'show_links' => false
			]); ?>
		</div>
	</div>
</footer>