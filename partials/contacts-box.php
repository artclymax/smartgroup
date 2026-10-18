<?php
$phones = get_field('contacts_phones', 'option') ?? '';
$emails = get_field('contacts_emails', 'option') ?? '';
$address = get_field('contacts_address', 'option') ?? '';
$links = get_field('contacts_links', 'option') ?? '';
$messengers = get_field('contacts_messengers', 'option') ?? '';
$show_messengers = $args['show_messengers'] ?? false;
$show_address = $args['show_address'] ?? true;
$show_links = $args['show_links'] ?? true;
?>
<div class="contacts-box">
	<?php if (!empty($phones)): ?>
		<ul class="contacts-box__list">
			<?php foreach ($phones as $phone): ?>
				<li class="contacts-box__item icon icon--phone">
					<a class="contacts-box__link link" href="tel:+<?php echo esc_attr(correct_phone($phone['phone'])) ?>">
						<?php echo esc_html($phone['phone']) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if (!empty($emails)): ?>
		<ul class="contacts-box__list">
			<?php foreach ($emails as $email): ?>
				<li class="contacts-box__item icon icon--email">
					<a class="contacts-box__link link" href="mailto:<?php echo esc_attr($email['email']) ?>">
						<?php echo esc_html($email['email']) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if (!empty($address) && $show_address): ?>
		<div class="contacts-box__content icon icon--address">
			<address class="contacts-box__descr descr">
				<?php echo wp_kses_post($address) ?>
			</address>
		</div>
	<?php endif; ?>
	<?php if (!empty($links) && $show_links): ?>
		<ul class="contacts-box__list">
			<?php foreach ($links as $link): ?>
				<li class="contacts-box__item icon icon--link"
					style="--icon-bg:url('<?php echo esc_attr(get_template_directory_uri() . '/assets/icons/link.svg') ?>')">
					<a class="contacts-box__link link" href="<?php echo esc_attr($link['link']['url']) ?>" target="_blank">
						<?php echo esc_html($link['link']['title']) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if (!empty($messengers) && $show_messengers): ?>
		<ul class="contacts-box__messengers">
			<?php foreach ($messengers as $msg): ?>
				<li class="contacts-box__messengers-item">
					<a class="contacts-box__messengers-link link-icon" href="<?php echo esc_attr($msg['link']['url']); ?>"
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
</div>