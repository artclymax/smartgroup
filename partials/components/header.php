<?php
$page = 'option';

$phones = get_field('contacts_phones', $page) ?? '';
$emails = get_field('contacts_emails', $page) ?? '';
$address = get_field('contacts_address', $page) ?? '';
$contacts_links = get_field('contacts_links', $page) ?? '';
$btn = get_field('header_btn', $page) ?? [];
$header_phone = get_field('header_phone', $page) ?: $phones[0]['phone'] ?? '';
$messengers = get_field('contacts_messengers', $page) ?? [];
$class = $args['class'] ?? '';
?>

<header class="header <?= esc_attr($class) ?>" data-auto-calc="header, height">
	<div class="header-top hidden-tablet">
		<div class="header-top__container container">
			<?php if (!empty($emails)): ?>
				<ul class="header-top__emails header-top__list">
					<?php foreach ($emails as $email): ?>
						<li class="header-top__item">
							<a class="header-top__link link" aria-label="Email"
								href="mailto:<?php echo esc_attr($email['email']); ?>">
								<?php echo esc_html($email['email']); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if (!empty($phones)): ?>
				<ul class="header-top__phones header-top__list">
					<?php foreach ($phones as $phone): ?>
						<li class="header-top__item">
							<a class="header-top__link link" aria-label="Телефон"
								href="tel:+<?php echo esc_attr(correct_phone($phone['phone'])); ?>">
								<?php echo esc_html($phone['phone']); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if (!empty($contacts_links)): ?>
				<ul class="header-top__phones header-top__list">
					<?php foreach ($contacts_links as $link): ?>
						<li class="header-top__item">
							<a class="header-top__link link" href="<?php echo esc_attr($link['link']['url']); ?>" target="_blank">
								<?php echo esc_html($link['link']['title']); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="container header__container">
		<!-- LOGO -->
		<div class="header__logo logo">
			<?php mx_logo(); ?>
		</div>
		<nav class="header__menu header-menu">
			<div class="header-menu__logo logo visible-tablet">
				<?php mx_logo(); ?>
			</div>
			<button class="header-menu__close-btn menu-close-btn visible-tablet" type="button" aria-label="Закрыть меню">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M18.75 6.81984L17.1802 5.25L12 10.4302L6.81984 5.25L5.25 6.81984L10.4302 12L5.25 17.1802L6.81984 18.75L12 13.5698L17.1802 18.75L18.75 17.1802L13.5698 12L18.75 6.81984Z"
						fill="currentColor" />
				</svg>
			</button>
			<div class="header-menu__wrapper">
				<div class="header-menu__item">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'header-menu',
						'container' => false,
						'menu_class' => 'mega-menu',
						'fallback_cb' => false,
						'depth' => 3
					));
					?>
				</div>
				<div class="header-menu__item header-menu__contacts-box visible-tablet">
					<h3 class="header-menu__title">
						Контакты
					</h3>
					<?php get_template_part('partials/contacts-box'); ?>
				</div>
				<!-- BTN -->
				<?php if ($btn): ?>
					<a class="header-menu__btn btn visible-tablet" href="<?php echo esc_html($btn['url']) ?>">
						<?php echo esc_html($btn['title']) ?>
					</a>
				<?php endif; ?>
			</div>
		</nav>

		<!-- VISIBLE MOBILE PHONE -->
		<?php if ($header_phone): ?>
			<a class="header__phone-btn phone-btn visible-tablet" aria-label="Телефон"
				href="tel:+<?php echo esc_attr(correct_phone($header_phone)); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M22.4503 17.3503C22.2056 17.0897 21.3417 16.3191 19.7536 15.2995C18.1537 14.2711 16.9739 13.6298 16.6354 13.4803C16.6056 13.4671 16.5727 13.4622 16.5404 13.4663C16.508 13.4703 16.4773 13.4831 16.4517 13.5033C15.9065 13.9284 14.9887 14.7094 14.9395 14.7516C14.6217 15.0239 14.6217 15.0239 14.3615 14.9391C13.904 14.7891 12.4828 14.0344 11.2443 12.7931C10.0059 11.5519 9.21231 10.0955 9.06231 9.63844C8.97653 9.37781 8.97653 9.37782 9.24981 9.06C9.292 9.01078 10.0734 8.09297 10.4986 7.54828C10.5187 7.52263 10.5315 7.49197 10.5356 7.4596C10.5396 7.42722 10.5348 7.39436 10.5215 7.36453C10.372 7.02563 9.73075 5.84625 8.70231 4.24641C7.68137 2.65875 6.91168 1.79485 6.65106 1.55016C6.62714 1.52759 6.59758 1.51189 6.56549 1.50471C6.5334 1.49754 6.49997 1.49915 6.46872 1.50938C5.55769 1.82245 4.67869 2.22192 3.84371 2.70235C3.03766 3.17092 2.27455 3.70973 1.56325 4.3125C1.53842 4.33361 1.5198 4.36108 1.5094 4.39197C1.49899 4.42285 1.49719 4.45598 1.50418 4.48781C1.60215 4.94438 2.07043 6.85032 3.52356 9.49032C5.00621 12.1847 6.03372 13.5652 8.21106 15.735C10.3884 17.9048 11.8125 18.9942 14.5097 20.4769C17.1497 21.93 19.0565 22.3988 19.5122 22.4958C19.5441 22.5027 19.5772 22.5009 19.6082 22.4905C19.6391 22.4801 19.6667 22.4615 19.6879 22.4367C20.2906 21.7254 20.8293 20.9623 21.2976 20.1563C21.778 19.3212 22.1774 18.4422 22.4906 17.5313C22.5006 17.5002 22.5022 17.4671 22.4951 17.4353C22.488 17.4035 22.4725 17.3741 22.4503 17.3503Z"
						fill="currentColor" />
				</svg>
			</a>
		<?php endif; ?>

		<!-- BURGER -->
		<button class="header__burger-btn burger-btn-icon header-mobile-btn visible-tablet" type="button"
			aria-label="Открыть/закрыть меню">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M20.25 15.75C20.6642 15.75 21 16.0858 21 16.5C21 16.9142 20.6642 17.25 20.25 17.25H3.75C3.33579 17.25 3 16.9142 3 16.5C3 16.0858 3.33579 15.75 3.75 15.75H20.25ZM20.25 11.25C20.6642 11.25 21 11.5858 21 12C21 12.4142 20.6642 12.75 20.25 12.75H3.75C3.33579 12.75 3 12.4142 3 12C3 11.5858 3.33579 11.25 3.75 11.25H20.25ZM20.25 6.75C20.6642 6.75 21 7.08579 21 7.5C21 7.91421 20.6642 8.25 20.25 8.25H3.75C3.33579 8.25 3 7.91421 3 7.5C3 7.08579 3.33579 6.75 3.75 6.75H20.25Z"
					fill="currentColor" />
			</svg>
		</button>
	</div>
</header>
<?php if (!empty($messengers)): ?>
	<ul class="header-messengers">
		<?php foreach ($messengers as $msg): ?>
			<li class="header-messengers__item">
				<a class="header-messengers__link link-icon" href="<?php echo esc_attr($msg['link']['url']); ?>"
					aria-label="<?php echo esc_attr($msg['link']['title']) ?? ''; ?> ">
					<?php echo wp_get_attachment_image(
						$msg['image']['ID'],
						'large',
						false,
						array(
							'class' => 'img',
							'alt' => $msg['image']['alt'] ?: ''
						)
					); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>