<?php
$page = 'option';
$logo = get_field('footer_logo', $page) ?? '';
$descr = get_field('footer_descr', $page) ?: get_bloginfo('description') ?? '';
$copy = get_field('footer_copy', $page) ?: '';
$links = get_field('footer_links', $page) ?? '';
$company = get_field('footer_company', $page) ?: get_bloginfo('name') ?? '';

?>

<footer class="footer">
	<div class="footer__container container">
		<div class="footer__top">
			<div class="footer__info">
				<div class="footer__logo logo">
					<?php mx_logo('', $logo); ?>
				</div>
			</div>
			<nav class="footer__menu footer-col">
				<h3 class="footer-col__title title-4">
					Разделы
				</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'container' => false,
						'menu_class' => 'footer-menu',
						'depth' => 1
					)
				); ?>
			</nav>
			<nav class="footer__menu footer-col">
				<h3 class="footer-col__title title-4">
					Каталог
				</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-category-menu',
						'container' => false,
						'menu_class' => 'footer-menu',
						'depth' => 1
					)
				); ?>
			</nav>
			<div class="footer-col footer__contacts-box">
				<h3 class="footer-col__title title-4">
					Контакты
				</h3>
				<?php get_template_part('partials/contacts-box'); ?>
			</div>
		</div>
		<div class="footer__bottom">
			<div class="footer__links">
				<?php if ($links): ?>
					<?php foreach ($links as $item): ?>
						<a class="footer__link link" href="<?php echo esc_attr($item['footer_links_link']['url'] ?? '') ?>"
							target="_blank">
							<?php echo esc_html($item['footer_links_link']['title'] ?? '') ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if ($copy || $company): ?>
					<div class="footer__copy">
						&copy;
						<?php echo esc_html($company) . ' ' . date('Y')  .'. ' . esc_html($copy) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>