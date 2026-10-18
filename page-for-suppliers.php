<?php
/*
Template Name: For suppliers
*/
?>
<?php get_header('suppliers'); ?>
<?php get_template_part('partials/header-suppliers'); ?>
<main class="main main--no-margin main--suppliers">
	<?php get_template_part('partials/suppliers/about'); ?>
	<?php get_template_part('partials/suppliers/cooperation'); ?>
	<?php get_template_part('partials/suppliers/why-us'); ?>
	<?php get_template_part('partials/suppliers/offer'); ?>
	<?php get_template_part('partials/suppliers/expectations'); ?>
	<?php get_template_part('partials/suppliers/market'); ?>
</main>
<?php get_template_part('partials/suppliers/footer'); ?>
<?php get_footer('suppliers'); ?>