<?php


if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Контактные данные',
		'menu_title' => 'Контактные данные',
		'menu_slug' => 'opt-contacts',
	));

	//acf_add_options_page(array(
	//	'page_title' => 'Общие поля товаров',
	//	'menu_title' => 'Общие поля товаров',
	//	'menu_slug' => 'opt-products',
	//));

	acf_add_options_page([
		'page_title' => 'Общие секции (партнёры / CTA-блок / Отзывы)',
		'menu_title' => 'Общие секции (партнёры / CTA-блок / Отзывы)',
		'menu_slug' => 'opt-shop-page',
		'position' => 15,
	]);
	acf_add_options_page(array(
		'page_title' => 'Шапка',
		'menu_title' => 'Шапка',
		'menu_slug' => 'opt-header',
	));

	acf_add_options_page(array(
		'page_title' => 'Подвал / Футер',
		'menu_title' => 'Подвал / Футер',
		'menu_slug' => 'opt-footer',
	));

	acf_add_options_page(array(
		'page_title' => 'Модальные окна',
		'menu_title' => 'Модальные окна',
		'menu_slug' => 'opt-modals',
	));

	acf_add_options_page(array(
		'page_title' => 'Страница благодарности',
		'menu_title' => 'Страница благодарности',
		'menu_slug' => 'opt-thank_you',
	));

	acf_add_options_page(array(
		'page_title' => 'Страница 404',
		'menu_title' => 'Страница 404',
		'menu_slug' => 'opt-page-404',
	));

}

// OPTIONS
add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	// HEADER
	acf_add_local_field_group(array(
		'key' => 'group_header_settings',
		'title' => 'Поля шапки',
		'fields' => array(
			array(
				'key' => 'field_header_info_message',
				'name' => 'header_info_message',
				'type' => 'message',
				'message' => '<b>Логотип</b> - перейдите в Панель управления сайтом > Основные настройки > Логотип сайта. <a href="' . admin_url('/admin.php?page=verda-settings&tab=general') . '" target="_blank">Перейти</a><br/><b>Меню</b> - перейдите в Панель управления сайтом > Меню > Меню шапки. <a href="' . admin_url('/admin.php?page=verda-settings&tab=menus') . '" target="_blank">Перейти</a><br/><b>Контакты</b> - перейдите в Панель управления сайтом > Редактирование контента > Основные секции > Контактные данные. <a href="' . admin_url('/admin.php?page=opt-contacts') . '" target="_blank">Перейти</a>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			// телефон
			array(
				'key' => 'field_header_phone',
				'label' => 'Телефон в шапке',
				'name' => 'header_phone',
				'type' => 'text',
			),

			// Кнопка
			array(
				'key' => 'field_header_btn',
				'label' => 'Кнопка в шапке',
				'name' => 'header_btn',
				'type' => 'link',
				'instructions' => 'Ссылка на модальное окно (якорь #modal-call) или страницу.',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-header',
				),
			),
		),
	));

	// FOOTER
	acf_add_local_field_group(array(
		'key' => 'flds_opt_footer',
		'title' => 'Поля футера',
		'fields' => array(
			array(
				'key' => 'footer_info_message',
				'name' => 'footer_info_message',
				'type' => 'message',
				'message' => '<b>Логотип</b> - перейдите в Панель управления сайтом > Основные настройки > Логотип сайта. <a href="' . admin_url('/admin.php?page=verda-settings&tab=general') . '" target="_blank">Перейти</a><br/><b>Меню</b> - перейдите в Панель управления сайтом > Меню > Меню шапки. <a href="' . admin_url('/admin.php?page=verda-settings&tab=menus') . '" target="_blank">Перейти</a><br/><b>Контакты</b> - перейдите в Панель управления сайтом > Редактирование контента > Основные секции > Контактные данные. <a href="' . admin_url('/admin.php?page=opt-contacts') . '" target="_blank">Перейти</a>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			array(
				'key' => 'footer_logo',
				'name' => 'footer_logo',
				'label' => 'Логотип',
				'type' => 'image',
			),
			//array(
			//	'key' => 'footer_descr',
			//	'name' => 'footer_descr',
			//	'label' => 'Описание',
			//	'type' => 'textarea',
			//	'new_lines' => 'wpautop',
			//	'rows' => 2,
			//),
			array(
				'key' => 'footer_company',
				'name' => 'footer_company',
				'label' => 'Название компании',
				'type' => 'text',
			),
			array(
				'key' => 'footer_copy',
				'name' => 'footer_copy',
				'label' => 'Копирайт',
				'type' => 'text',
			),
			array(
				'key' => 'footer_links',
				'name' => 'footer_links',
				'label' => 'Ссылки',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'footer_links_link',
						'name' => 'footer_links_link',
						'label' => 'Ссылка',
						'type' => 'link',
					),
				)
			)
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-footer',
				),
			),
		),
	));

	// CONTACTS
	acf_add_local_field_group(array(
		'key' => 'group_contacts_page',
		'title' => 'Страница: Контакты',
		'fields' => array(
			array(
				'key' => 'field_contacts_tab_phones',
				'label' => 'Телефон',
				'name' => 'contacts_tab_phones',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_phones',
				'label' => 'Телефоны',
				'name' => 'contacts_phones',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_contact_phone_number',
				'button_label' => 'Добавить телефон',
				'sub_fields' => array(
					array(
						'key' => 'field_contact_phone_number',
						'label' => 'Номер телефона',
						'name' => 'phone',
						'type' => 'text',
					),
				)
			),
			array(
				'key' => 'field_contacts_tab_email',
				'label' => 'Email',
				'name' => 'contacts_tab_email',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_emails',
				'label' => 'Email адреса',
				'name' => 'contacts_emails',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_contact_email_link',
				'button_label' => 'Добавить email',
				'sub_fields' => array(
					array(
						'key' => 'field_contact_email_link',
						'label' => 'Email',
						'name' => 'email',
						'type' => 'email',
					)
				)
			),
			array(
				'key' => 'field_contacts_tab_address_time',
				'label' => 'Адрес',
				'name' => 'contacts_tab_address_time',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_address',
				'label' => 'Почтовый адрес',
				'name' => 'contacts_address',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_contacts_ur_address',
				'label' => 'Юридический адрес:',
				'name' => 'contacts_ur_address',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_contacts_tab_messengers',
				'label' => 'Мессенджеры и соцсети',
				'name' => 'contacts_tab_messengers',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_messengers',
				'label' => 'Мессенджеры',
				'name' => 'contacts_messengers',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_contact_phone_icon',
						'label' => 'Иконка',
						'name' => 'image',
						'type' => 'image',
					),
					array(
						'key' => 'field_contact_phone_link',
						'label' => 'Ссылка',
						'name' => 'link',
						'type' => 'link',
					)
				)
			),
			array(
				'key' => 'field_contacts_tab_map',
				'label' => 'Карта',
				'name' => 'contacts_tab_map',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_map',
				'label' => 'Карта',
				'name' => 'contacts_map',
				'type' => 'textarea',
				'instructions' => 'Код iframe'
			),
			array(
				'key' => 'field_contacts_tab_links',
				'label' => 'Ссылки на страницы',
				'name' => 'contacts_tab_links',
				'type' => 'tab',
			),
			array(
				'key' => 'field_contacts_links',
				'label' => 'Ссылки на страницы',
				'name' => 'contacts_links',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_contact_link',
						'label' => 'Ссылка',
						'name' => 'link',
						'type' => 'link',
					)
				)
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-contacts'
				)
			)
		),
		'menu_order' => 0,
	));

	// MODALS
	acf_add_local_field_group(array(
		'key' => 'group_opt_modals',
		'title' => 'Глобальные модальные окна',
		'fields' => array(
			array(
				'key' => 'field_modals_list',
				'label' => 'Список модальных окон',
				'name' => 'modals',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_modal_id',
				'button_label' => 'Добавить модальное окно',
				'sub_fields' => array(
					array(
						'key' => 'field_modal_id',
						'label' => 'ID модального окна',
						'name' => 'id',
						'type' => 'text',
						'required' => 1,
						'maxlength' => 50,
						'instructions' => 'Только латиница, цифры, дефис. Пример: <code>order-form</code>. Используется в <code>id</code> и <code>data-modal</code>.',
						'prepend' => '#',
						'character_limit' => 50,
						'allow_custom' => 0,
					),
					array(
						'key' => 'field_modal_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_modal_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'wysiwyg',
					),
					array(
						'key' => 'field_modal_shortcode',
						'label' => 'Шорткод формы',
						'name' => 'shortcode',
						'type' => 'text',
						'placeholder' => '[contact-form-7 id="123"]',
						'instructions' => 'Вставьте шорткод форм (CF7, WPForms, Forminator и свой шорткод).',
					),
					array(
						'key' => 'field_modal_image',
						'label' => 'Картинка',
						'name' => 'image',
						'type' => 'image',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-modals',
				),
			),
		),
	));


	// THANK YOU
	acf_add_local_field_group(array(
		'key' => 'flds_opt_thank_you',
		'title' => 'Страница благодарности',
		'fields' => array(
			array(
				'key' => 'field_thank_you_title',
				'name' => 'thank_you_title',
				'label' => 'Заголовок',
				'type' => 'text',
			),
			array(
				'key' => 'field_thank_you_descr',
				'name' => 'thank_you_descr',
				'label' => 'Описание',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_thank_you_btn',
				'name' => 'thank_you_btn',
				'label' => 'Кнопка',
				'type' => 'link',
			),
			array(
				'key' => 'field_thank_you_image',
				'name' => 'thank_you_image',
				'label' => 'Картинка',
				'type' => 'image',
			),
			//array(
			//	'key' => 'field_thank_you_image_mobile',
			//	'name' => 'thank_you_image_mobile',
			//	'label' => 'Картинка мобильная',
			//	'type' => 'image',
			//)
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-thank_you',
				),
			),
		),
	));

	// PAGE 404 
	acf_add_local_field_group(array(
		'key' => 'flds_opt_page_404',
		'title' => 'Страница благодарности',
		'fields' => array(
			array(
				'key' => 'field_page_404_title',
				'name' => 'page_404_title',
				'label' => 'Заголовок',
				'type' => 'text',
			),
			array(
				'key' => 'field_page_404_descr',
				'name' => 'page_404_descr',
				'label' => 'Описание',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_page_404_btn',
				'name' => 'page_404_btn',
				'label' => 'Кнопка',
				'type' => 'link',
			),
			//array(
			//	'key' => 'field_page_404_image',
			//	'name' => 'page_404_image',
			//	'label' => 'Картинка',
			//	'type' => 'image',
			//),
			array(
				'key' => 'field_page_404_image_num',
				'name' => 'page_404_image_num',
				'label' => 'Картинка 404',
				'type' => 'image',
			),
			//array(
			//	'key' => 'field_page_404_image_404',
			//	'name' => 'page_404_image_404',
			//	'label' => 'Картинка c цифрой 404',
			//	'type' => 'image',
			//),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-page-404',
				),
			),
		),
	));

	// SECTIONS
});


add_action('acf/init', 'register_fields');
function register_fields()
{
	$page = get_page_by_path('home', OBJECT, 'page');
	// !== COMMON ===
	// hero
	acf_add_local_field_group([
		'key' => 'group_hero_page_section',
		'title' => 'Первый экран',
		'fields' => [
			[
				'key' => 'field_hero_page_title',
				'label' => 'Заголовок H1',
				'name' => 'hero_title',
				'type' => 'text',
			],
			[
				'key' => 'field_hero_page_descr',
				'label' => 'Описание',
				'name' => 'hero_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_hero_page_btn',
				'label' => 'Кнопка',
				'name' => 'hero_btn',
				'type' => 'link'
			],
			[
				'key' => 'field_hero_page_image',
				'label' => 'Фоновая картинка',
				'name' => 'hero_image',
				'type' => 'image',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '!=',
					'value' => 'front-page.php'
				],
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page'
				]
			],
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 1,
	]);
	acf_add_local_field_group([
		'key' => 'group_category_about',
		'title' => 'Секция "О категории"',
		'fields' => [
			[
				'key' => 'field_cat_about_label',
				'label' => 'Надзаголовок',
				'name' => 'cat_about_label',
				'type' => 'text',
			],
			[
				'key' => 'field_cat_about_title',
				'label' => 'Заголовок',
				'name' => 'cat_about_title',
				'type' => 'text',
			],
			[
				'key' => 'field_cat_about_descr',
				'label' => 'Описание',
				'name' => 'cat_about_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_cat_about_image',
				'label' => 'Изображение',
				'name' => 'cat_about_image',
				'type' => 'image',
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_category_children_list',
		'title' => 'Секция "Дочерние категории"',
		'fields' => [
			[
				'key' => 'field_cat_children_selected',
				'label' => 'Выбрать дочерние категории для показа',
				'name' => 'cat_children_selected',
				'type' => 'taxonomy',
				'taxonomy' => 'product_cat',
				'field_type' => 'checkbox',
				'return_format' => 'object',
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'instructions' => 'Если ничего не выбрано, будут показаны все дочерние категории'
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_category_products',
		'title' => 'Секция "Товары категории"',
		'fields' => [
			[
				'key' => 'field_category_products_show_product',
				'label' => 'Показывать секцию товаров',
				'name' => 'category_products_show_product',
				'type' => 'true_false',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => 'Показывать',
				'ui_off_text' => 'Скрыть',
				'instructions' => 'Отключите, если не хотите показывать товары этой категории'
			],
			[
				'key' => 'field_category_products_title',
				'label' => 'Заголовок секции',
				'name' => 'category_products_title',
				'type' => 'text',
				'default_value' => 'Состав оборудования',
				'placeholder' => 'Состав оборудования'
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 4,
		'position' => 'normal',
	]);
	acf_add_local_field_group([
		'key' => 'group_category_description',
		'title' => 'Секция "Описание категории"',
		'fields' => [
			[
				'key' => 'field_category_description_title',
				'label' => 'Заголовок',
				'name' => 'category_description_title',
				'type' => 'text',
				'default_value' => 'Описание решения'
			],
			[
				'key' => 'field_category_description_descr',
				'label' => 'Описание',
				'name' => 'category_description_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_category_description_image',
				'label' => 'Изображение',
				'name' => 'category_description_image',
				'type' => 'image',
			],
			[
				'key' => 'field_category_description_list',
				'label' => 'Список преимуществ',
				'name' => 'category_description_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_category_description_list_title',
				'sub_fields' => [
					[
						'key' => 'field_category_description_list_image',
						'label' => 'Иконка',
						'name' => 'image',
						'type' => 'image',
					],
					[
						'key' => 'field_category_description_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_category_description_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 5,
	]);
	acf_add_local_field_group([
		'key' => 'group_category_specs',
		'title' => 'Секция "Технические характеристики"',
		'fields' => [
			[
				'key' => 'field_category_specs_title',
				'label' => 'Заголовок',
				'name' => 'category_specs_title',
				'type' => 'text',
				'default_value' => 'Технические характеристики'
			],
			[
				'key' => 'field_category_specs_list',
				'label' => 'Список характеристик',
				'name' => 'category_specs_list',
				'type' => 'repeater',
				'layout' => 'table',
				'collapsed' => 'field_category_specs_list_key',
				'button_label' => 'Добавить характеристику',
				'sub_fields' => [
					[
						'key' => 'field_category_specs_list_key',
						'label' => 'Название',
						'name' => 'key',
						'type' => 'textarea',
						'rows' => 2,
						'column_width' => '40'
					],
					[
						'key' => 'field_category_specs_list_value',
						'label' => 'Значение',
						'name' => 'value',
						'type' => 'textarea',
						'rows' => 2,
						'column_width' => '60'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 6,
	]);
	// section-news
	acf_add_local_field_group([
		'key' => 'group_section_news',
		'title' => 'Секция "Новости"',
		'fields' => [
			[
				'key' => 'field_section_news_message',
				'label' => 'Инструкция',
				'type' => 'message',
				'message' => '<b>Чтобы добавить Новости > Перейдите в Панель управления сайтом > Записи > Новости.</b><br/><a href="' . esc_url(home_url('/wp-admin/edit.php?post_type=news')) . '" target="_blank">Перейти</a>'
			],
			[
				'key' => 'field_section_news_label',
				'label' => 'Надзаголовок',
				'name' => 'section_news_label',
				'type' => 'text'
			],
			[
				'key' => 'field_section_news_title',
				'label' => 'Заголовок',
				'name' => 'section_news_title',
				'type' => 'text'
			],
			[
				'key' => 'field_section_news_descr',
				'label' => 'Описание',
				'name' => 'section_news_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_section_news_btn',
				'label' => 'Кнопка "Все новости"',
				'name' => 'section_news_btn',
				'type' => 'link',
				'instructions' => 'Если не заполнено, кнопка будет вести на архив новостей (/news/)'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 7,
	]);
	// cta-block
	acf_add_local_field_group([
		'key' => 'group_cta_block',
		'title' => 'Секция "CTA-блок"',
		'fields' => [
			[
				'key' => 'field_cta_block_title',
				'label' => 'Заголовок',
				'name' => 'cta_block_title',
				'type' => 'text'
			],
			[
				'key' => 'field_cta_block_descr',
				'label' => 'Описание',
				'name' => 'cta_block_descr',
				'type' => 'textarea',
				'rows' => 3,
				'new_lines' => 'wpautop'
			],
			[
				'key' => 'field_cta_block_btn',
				'label' => 'Кнопка',
				'name' => 'cta_block_btn',
				'type' => 'link'
			],
			[
				'key' => 'field_cta_block_image',
				'label' => 'Изображение',
				'name' => 'cta_block_image',
				'type' => 'image',
				'return_format' => 'array',
			],
			[
				'key' => 'field_cta_block_image_mobile',
				'label' => 'Изображение (мобильное)',
				'name' => 'cta_block_image_mobile',
				'type' => 'image',
				'return_format' => 'array',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-shop-page'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_partners',
		'title' => 'Секция "Партнёры"',
		'fields' => [
			[
				'key' => 'field_partners_label',
				'label' => 'Надзаголовок',
				'name' => 'partners_label',
				'type' => 'text'
			],
			[
				'key' => 'field_partners_title',
				'label' => 'Заголовок',
				'name' => 'partners_title',
				'type' => 'text'
			],
			[
				'key' => 'field_partners_descr',
				'label' => 'Описание',
				'name' => 'partners_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_partners_gallery',
				'label' => 'Логотипы партнёров',
				'name' => 'partners_gallery',
				'type' => 'gallery',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-shop-page'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_reviews_section_settings',
		'title' => 'Секция "Отзывы"',
		'fields' => [
			[
				'key' => 'field_reviews_section_label',
				'label' => 'Надзаголовок',
				'name' => 'reviews_section_label',
				'type' => 'text'
			],
			[
				'key' => 'field_reviews_section_title',
				'label' => 'Заголовок',
				'name' => 'reviews_section_title',
				'type' => 'text'
			],
			[
				'key' => 'field_reviews_section_descr',
				'label' => 'Описание',
				'name' => 'reviews_section_descr',
				'type' => 'wysiwyg',
			],
			array(
				'key' => 'field_reviews_section_message',
				'label' => 'Инструкция',
				'type' => 'message',
				'message' => '<b>Чтобы добавить Отзыв > Перейдите в Панель управления сайтом > Записи > Отзыв.</b><br/><a href="' . esc_url(home_url('/wp-admin/edit.php?post_type=review')) . '" target="_blank">Перейти</a>'
			)
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opt-shop-page'
				]
			]
		],
		'menu_order' => 3,
	]);

	// !== HOME
	// HERO
	acf_add_local_field_group([
		'key' => 'group_hero_section',
		'title' => 'Первый экран',
		'fields' => [
			[
				'key' => 'field_hero_title',
				'label' => 'Заголовок H1',
				'name' => 'hero_title',
				'type' => 'text',
			],
			[
				'key' => 'field_hero_descr',
				'label' => 'Описание',
				'name' => 'hero_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_hero_btn_first',
				'label' => 'Кнопка 1 (Основная)',
				'name' => 'hero_btn_first',
				'type' => 'link'
			],
			[
				'key' => 'field_hero_btn_second',
				'label' => 'Кнопка 2 (Второстепенная)',
				'name' => 'hero_btn_second',
				'type' => 'link'
			],
			[
				'key' => 'field_hero_list',
				'label' => 'Список преимуществ (слайдер)',
				'name' => 'hero_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_hero_list_title',
				'sub_fields' => [
					[
						'key' => 'field_hero_list_image',
						'label' => 'Изображение',
						'name' => 'image',
						'type' => 'image'
					],
					[
						'key' => 'field_hero_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_hero_list_subtitle',
						'label' => 'Дополнение к заголовку (без анимации набегания)',
						'name' => 'subtitle',
						'type' => 'text'
					],
					[
						'key' => 'field_hero_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
			[
				'key' => 'field_hero_media',
				'label' => 'Медиа (видео или изображение)',
				'name' => 'hero_media',
				'type' => 'file',
				'return_format' => 'array',
				'library' => 'all',
				'mime_types' => 'mp4,webm,jpg,jpeg,png,webp',
				'instructions' => 'Загрузите видео (MP4/WebM) или изображение. Видео будет воспроизводиться автоматически.'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 1,
	]);
	// services
	acf_add_local_field_group([
		'key' => 'group_services_grid',
		'title' => 'Секция "Сетка услуг/категорий"',
		'fields' => [
			[
				'key' => 'field_services_grid_list',
				'label' => 'Список категорий',
				'name' => 'services_grid_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_services_grid_list_title',
				'sub_fields' => [
					[
						'key' => 'field_services_grid_list_image',
						'label' => 'Изображение',
						'name' => 'image',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium'
					],
					[
						'key' => 'field_services_grid_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text',
						'instructions' => 'Если оставить пустым, будет использовано название категории'
					],
					[
						'key' => 'field_services_grid_list_category',
						'label' => 'Категория',
						'name' => 'category',
						'type' => 'taxonomy',
						'taxonomy' => 'product_cat',
						'field_type' => 'select',
						'return_format' => 'object',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 0,
						'load_terms' => 0,
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 10,
	]);
	// about
	acf_add_local_field_group([
		'key' => 'group_about_smart_group',
		'title' => 'Секция "О компании / Преимущества"',
		'fields' => [
			[
				'key' => 'field_about_label',
				'label' => 'Надзаголовок',
				'name' => 'about_label',
				'type' => 'text'
			],
			[
				'key' => 'field_about_title',
				'label' => 'Заголовок',
				'name' => 'about_title',
				'type' => 'text'
			],
			[
				'key' => 'field_about_descr',
				'label' => 'Описание',
				'name' => 'about_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_about_list',
				'label' => 'Список преимуществ',
				'name' => 'about_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_about_list_title',
				'sub_fields' => [
					[
						'key' => 'field_about_list_icon',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					],
					[
						'key' => 'field_about_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_about_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
			[
				'key' => 'field_about_btn',
				'label' => 'Кнопка',
				'name' => 'about_btn',
				'type' => 'link'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	// catalog
	acf_add_local_field_group([
		'key' => 'group_catalog_section',
		'title' => 'Секция "Каталог"',
		'fields' => [
			[
				'key' => 'field_catalog_label',
				'label' => 'Надзаголовок',
				'name' => 'catalog_label',
				'type' => 'text'
			],
			[
				'key' => 'field_catalog_title',
				'label' => 'Заголовок',
				'name' => 'catalog_title',
				'type' => 'text'
			],
			[
				'key' => 'field_catalog_descr',
				'label' => 'Описание',
				'name' => 'catalog_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_catalog_selected_cats',
				'label' => 'Выбрать категории для показа',
				'name' => 'catalog_selected_cats',
				'type' => 'taxonomy',
				'taxonomy' => 'product_cat',
				'field_type' => 'checkbox', // Или 'multi_select', 'select'
				'return_format' => 'object',
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'instructions' => 'Если ничего не выбрано, будут показаны 6 категорий верхнего уровня'
			],
			[
				'key' => 'field_catalog_btn',
				'label' => 'Кнопка',
				'name' => 'catalog_btn',
				'type' => 'link'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 4,
	]);
	//support
	acf_add_local_field_group([
		'key' => 'group_support_section',
		'title' => 'Секция "Сервисная поддержка"',
		'fields' => [
			[
				'key' => 'field_support_label',
				'label' => 'Надзаголовок',
				'name' => 'support_label',
				'type' => 'text'
			],
			[
				'key' => 'field_support_title',
				'label' => 'Заголовок',
				'name' => 'support_title',
				'type' => 'text'
			],
			[
				'key' => 'field_support_descr',
				'label' => 'Описание',
				'name' => 'support_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_support_list',
				'label' => 'Список преимуществ',
				'name' => 'support_list',
				'type' => 'repeater',
				'layout' => 'table',
				'collapsed' => 'field_support_list_descr',
				'button_label' => 'Добавить пункт',
				'sub_fields' => [
					[
						'key' => 'field_support_list_descr',
						'label' => 'Текст пункта',
						'name' => 'descr',
						'type' => 'text',
					],
				],
			],
			[
				'key' => 'field_support_btn',
				'label' => 'Кнопка "Получить консультацию"',
				'name' => 'support_btn',
				'type' => 'link'
			],
			[
				'key' => 'field_support_cards',
				'label' => 'Карточки услуг',
				'name' => 'support_cards',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_support_cards_title',
				'button_label' => 'Добавить карточку',
				'sub_fields' => [
					[
						'key' => 'field_support_cards_icon',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					],
					[
						'key' => 'field_support_cards_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_support_cards_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
			[
				'key' => 'field_support_bg_big',
				'label' => 'Фоновое изображение (Desktop)',
				'name' => 'support_bg_big',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => 'Изображение для десктопной версии'
			],
			[
				'key' => 'field_support_bg_small',
				'label' => 'Фоновое изображение (Mobile)',
				'name' => 'support_bg_small',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => 'Изображение для мобильной версии'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 5,
	]);
	// contacts-form
	acf_add_local_field_group([
		'key' => 'group_contacts_form_section',
		'title' => 'Секция "Контакты с формой"',
		'fields' => [
			[
				'key' => 'field_contacts_form_message',
				'label' => 'Инструкция',
				'type' => 'message',
				'message' => '<b>Чтобы изменить контакты</b>, перейдите в Панель управления сайтом > Редактирования контента > Основные секции > Контактные данные. <a href="' . admin_url('/admin.php?page=opt-contacts') . '" target="_blank">Перейти</a><br/>'
			],
			[
				'key' => 'field_contacts_form_label',
				'label' => 'Надзаголовок',
				'name' => 'contacts_form_label',
				'type' => 'text'
			],
			[
				'key' => 'field_contacts_form_title',
				'label' => 'Заголовок секции',
				'name' => 'contacts_form_title',
				'type' => 'text'
			],
			[
				'key' => 'field_contacts_form_descr',
				'label' => 'Описание секции',
				'name' => 'contacts_form_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_contacts_form_form_title',
				'label' => 'Заголовок над формой',
				'name' => 'contacts_form_form_title',
				'type' => 'text',
			],
			[
				'key' => 'field_contacts_form_shortcode',
				'label' => 'Шорткод формы',
				'name' => 'contacts_form_shortcode',
				'type' => 'text',
				'instructions' => 'Вставьте шорткод CF7, WPForms или другой'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'front-page.php'
				]
			]
		],
		'menu_order' => 24,
	]);

	//! product_cat
	acf_add_local_field_group([
		'key' => 'group_product_cat_card',
		'title' => 'Карточка категории товара',
		'fields' => [
			[
				'key' => 'field_product_cat_card_image',
				'label' => 'Изображение категории',
				'name' => 'cat_card_image',
				'type' => 'image',
			],
			[
				'key' => 'field_product_cat_card_title',
				'label' => 'Заголовок',
				'name' => 'cat_card_title',
				'type' => 'text',
				'placeholder' => 'Например: Линии переработки',
				'instructions' => 'Если оставить пустым, будет использовано название категории'
			],
			[
				'key' => 'field_product_cat_card_descr',
				'label' => 'Описание',
				'name' => 'cat_card_descr',
				'type' => 'textarea',
				'rows' => 3,
				'new_lines' => 'wpautop',
				'placeholder' => 'Краткое описание категории...',
				'instructions' => 'Будет отображено в карточке категории'
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat'
				]
			]
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => 'Поля для карточки категории товара (изображение, заголовок, описание)',
	]);
	//! single-review
	acf_add_local_field_group([
		'key' => 'group_review_fields',
		'title' => 'Данные отзыва',
		'fields' => [
			[
				'key' => 'field_review_company',
				'label' => 'Компания',
				'name' => 'review_company',
				'type' => 'text',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'review'
				]
			]
		],
		'menu_order' => 0,
	]);
	//! single-product
	acf_add_local_field_group([
		'key' => 'group_product_btn',
		'title' => 'Кнопка',
		'fields' => [
			[
				'key' => 'field_product_btn',
				'label' => 'Кнопка',
				'name' => 'product_btn',
				'type' => 'link',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product'
				]
			]
		],
		'menu_order' => 2,
		'position' => 'normal',
	]);
	acf_add_local_field_group([
		'key' => 'group_product_videos',
		'title' => 'Видео товара',
		'fields' => [
			[
				'key' => 'field_product_videos',
				'label' => 'Видео',
				'name' => 'product_videos',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_product_videos_title',
				'button_label' => 'Добавить видео',
				'sub_fields' => [
					[
						'key' => 'field_product_videos_title',
						'label' => 'Название (для alt)',
						'name' => 'title',
						'type' => 'text',
						'placeholder' => 'Обзор товара'
					],
					[
						'key' => 'field_product_videos_file',
						'label' => 'Видеофайл',
						'name' => 'file',
						'type' => 'file',
						'return_format' => 'array',
						'mime_types' => 'mp4,webm',
					],
					[
						'key' => 'field_product_videos_cover',
						'label' => 'Обложка видео',
						'name' => 'cover',
						'type' => 'image',
						'return_format' => 'array',
						'instructions' => 'Кадр, который показывается до воспроизведения'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product'
				]
			]
		],
		'menu_order' => 6,
		'position' => 'normal',
	]);
	acf_add_local_field_group([
		'key' => 'group_product_details',
		'title' => 'Детали товара (Характеристики и Документация)',
		'fields' => [
			// Характеристики
			[
				'key' => 'field_product_specs',
				'label' => 'Характеристики',
				'name' => 'product_specs',
				'type' => 'repeater',
				'layout' => 'table',
				'collapsed' => 'field_product_specs_key',
				'button_label' => 'Добавить характеристику',
				'sub_fields' => [
					[
						'key' => 'field_product_specs_key',
						'label' => 'Название',
						'name' => 'key',
						'type' => 'text',
						'column_width' => '40'
					],
					[
						'key' => 'field_product_specs_value',
						'label' => 'Значение',
						'name' => 'value',
						'type' => 'text',
						'column_width' => '60'
					],
				],
			],
			// Документация
			[
				'key' => 'field_product_docs',
				'label' => 'Документация',
				'name' => 'product_docs',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_product_docs_title',
				'button_label' => 'Добавить документ',
				'sub_fields' => [
					[
						'key' => 'field_product_docs_title',
						'label' => 'Название документа',
						'name' => 'title',
						'type' => 'text',
						'placeholder' => 'Руководство по эксплуатации',
						'instructions' => 'Если оставить пустым, будет использовано имя файла'
					],
					[
						'key' => 'field_product_docs_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'text',
						'placeholder' => 'Краткое описание документа'
					],
					[
						'key' => 'field_product_docs_file',
						'label' => 'Файл',
						'name' => 'file',
						'type' => 'file',
						'return_format' => 'array',
						'mime_types' => 'pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar',
						'instructions' => 'PDF, DOC, XLS и другие форматы'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product'
				]
			]
		],
		'menu_order' => 7,
		'position' => 'normal',
	]);
	//! ABOUT
	acf_add_local_field_group([
		'key' => 'group_about_company',
		'title' => 'Секция "О компании"',
		'fields' => [
			[
				'key' => 'field_about_company_label',
				'label' => 'Надзаголовок',
				'name' => 'about_company_label',
				'type' => 'text'
			],
			[
				'key' => 'field_about_company_title',
				'label' => 'Заголовок',
				'name' => 'about_company_title',
				'type' => 'text'
			],
			[
				'key' => 'field_about_company_descr',
				'label' => 'Описание',
				'name' => 'about_company_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_about_company_btn',
				'label' => 'Кнопка "Подробнее"',
				'name' => 'about_company_btn',
				'type' => 'link'
			],
			[
				'key' => 'field_about_company_image',
				'label' => 'Изображение',
				'name' => 'about_company_image',
				'type' => 'image',
				'instructions' => 'Большое изображение на всю ширину секции'
			],
			[
				'key' => 'field_about_company_cards',
				'label' => 'Карточки преимуществ',
				'name' => 'about_company_cards',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_about_company_cards_title',
				'button_label' => 'Добавить карточку',
				'sub_fields' => [
					[
						'key' => 'field_about_company_cards_icon',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					],
					[
						'key' => 'field_about_company_cards_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-about.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_about_directions',
		'title' => 'Секция "Ключевые направления"',
		'fields' => [
			[
				'key' => 'field_about_directions_label',
				'label' => 'Надзаголовок',
				'name' => 'about_directions_label',
				'type' => 'text'
			],
			[
				'key' => 'field_about_directions_title',
				'label' => 'Заголовок',
				'name' => 'about_directions_title',
				'type' => 'text'
			],
			[
				'key' => 'field_about_directions_list',
				'label' => 'Список направлений',
				'name' => 'about_directions_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_about_directions_list_title',
				'button_label' => 'Добавить направление',
				'sub_fields' => [
					[
						'key' => 'field_about_directions_list_image',
						'label' => 'Картинка',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'Основное фото карточки'
					],
					[
						'key' => 'field_about_directions_list_icon',
						'label' => 'Иконка направления',
						'name' => 'icon',
						'type' => 'image',
						'return_format' => 'array',
						'instructions' => 'Рекомендуется SVG'
					],
					[
						'key' => 'field_about_directions_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_about_directions_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
					[
						'key' => 'field_about_directions_list_category',
						'label' => 'Категория',
						'name' => 'category',
						'type' => 'taxonomy',
						'taxonomy' => 'product_cat',
						'field_type' => 'select',
						'return_format' => 'object',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 0,
						'load_terms' => 0,
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-about.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_about_why_us',
		'title' => 'Секция "Почему выбирают нас"',
		'fields' => [
			[
				'key' => 'field_about_why_us_title',
				'label' => 'Заголовок',
				'name' => 'about_why_us_title',
				'type' => 'text',
				'default_value' => 'Почему выбирают Смарт Групп Компани'
			],
			[
				'key' => 'field_about_why_us_list',
				'label' => 'Список преимуществ',
				'name' => 'about_why_us_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_about_why_us_list_title',
				'button_label' => 'Добавить преимущество',
				'sub_fields' => [
					[
						'key' => 'field_about_why_us_list_icon',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					],
					[
						'key' => 'field_about_why_us_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
				],
			],
			[
				'key' => 'field_about_why_us_image',
				'label' => 'Фоновое изображение',
				'name' => 'about_why_us_image',
				'type' => 'image',
				'return_format' => 'array',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-about.php'
				]
			]
		],
		'menu_order' => 4,
	]);
	acf_add_local_field_group([
		'key' => 'group_about_process',
		'title' => 'Секция "Этапы работы"',
		'fields' => [
			[
				'key' => 'field_about_process_label',
				'label' => 'Надзаголовок',
				'name' => 'about_process_label',
				'type' => 'text'
			],
			[
				'key' => 'field_about_process_title',
				'label' => 'Заголовок',
				'name' => 'about_process_title',
				'type' => 'text'
			],
			[
				'key' => 'field_about_process_list',
				'label' => 'Список этапов',
				'name' => 'about_process_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_about_process_list_title',
				'button_label' => 'Добавить этап',
				'sub_fields' => [
					[
						'key' => 'field_about_process_list_image',
						'label' => 'Иконка',
						'name' => 'image',
						'type' => 'image',
					],
					[
						'key' => 'field_about_process_list_title',
						'label' => 'Заголовок этапа',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_about_process_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-about.php'
				]
			]
		],
		'menu_order' => 2,
	]);

	// !NEWS
	acf_add_local_field_group([
		'key' => 'group_featured_news',
		'title' => 'Актуальные материалы',
		'fields' => [
			[
				'key' => 'field_featured_news_label',
				'label' => 'Надзаголовок',
				'name' => 'featured_news_label',
				'type' => 'text',
			],
			[
				'key' => 'field_featured_news_title',
				'label' => 'Заголовок',
				'name' => 'featured_news_title',
				'type' => 'text',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-news.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_page_news',
		'title' => 'Все материалы',
		'fields' => [
			[
				'key' => 'field_page_news_label',
				'label' => 'Надзаголовок',
				'name' => 'page_news_label',
				'type' => 'text',
			],
			[
				'key' => 'field_page_news_title',
				'label' => 'Заголовок',
				'name' => 'page_news_title',
				'type' => 'text',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-news.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_news_gallery',
		'title' => 'Галерея',
		'fields' => [
			[
				'key' => 'field_news_gallery',
				'label' => 'Галерея',
				'name' => 'news_gallery',
				'type' => 'gallery',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'news'
				]
			]
		],
		'menu_order' => 0,
	]);
	//! CONTACTS
	acf_add_local_field_group([
		'key' => 'group_contacts_page_template',
		'title' => 'Поля контактов',
		'fields' => [
			[
				'key' => 'field_contacts_page_message',
				'name' => 'contacts_page_message',
				'type' => 'message',
				'message' => '<b>Контакты</b> - перейдите в Панель управления сайтом > Редактирование контента > Основные секции > Контактные данные. <a href="' . admin_url('/admin.php?page=opt-contacts') . '" target="_blank">Перейти</a>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			],
			[
				'key' => 'field_contacts_page_form_title',
				'name' => 'contacts_page_form_title',
				'label' => 'Заголовок формы',
				'type' => 'text',
			],
			[
				'key' => 'field_contacts_page_form',
				'name' => 'contacts_page_form',
				'label' => 'Шорткод формы',
				'type' => 'text',
			],
			[
				'key' => 'field_contacts_page_map_title',
				'name' => 'contacts_page_map_title',
				'label' => 'Заголовок карты',
				'type' => 'text',
			]
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-contacts.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	//! JOBS
	acf_add_local_field_group([
		'key' => 'group_jobs_section',
		'title' => 'Секция "Вакансии"',
		'fields' => [
			[
				'key' => 'field_jobs_section_title',
				'label' => 'Заголовок секции',
				'name' => 'jobs_section_title',
				'type' => 'text',
				'default_value' => 'Открытые позиции'
			],
			[
				'key' => 'field_jobs_form_title',
				'label' => 'Заголовок формы отклика',
				'name' => 'jobs_form_title',
				'type' => 'text',
				'default_value' => 'Отправить отклик'
			],
			[
				'key' => 'field_jobs_form_shortcode',
				'label' => 'Шорткод формы отклика',
				'name' => 'jobs_form_shortcode',
				'type' => 'text',
				'placeholder' => '[contact-form-7 id="123" title="Отклик на вакансию"]',
				'instructions' => 'Вставьте шорткод CF7, WPForms или другой формы'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-jobs.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	// jobs-single
	acf_add_local_field_group([
		'key' => 'group_job_fields',
		'title' => 'Данные вакансии',
		'fields' => [
			[
				'key' => 'field_job_location',
				'label' => 'Локация / формат работы',
				'name' => 'job_location',
				'type' => 'text',
				'instructions' => 'Например: г.Минск, удаленная работа'
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'job'
				]
			]
		],
		'menu_order' => 0,
	]);
	//! REVIEWS
	acf_add_local_field_group([
		'key' => 'group_reviews_section',
		'title' => 'Секция "Вакансии"',
		'fields' => [
			[
				'key' => 'field_reviews_section_title',
				'label' => 'Заголовок секции',
				'name' => 'reviews_section_title',
				'type' => 'text',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-reviews.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	//! SERVICES
	acf_add_local_field_group([
		'key' => 'group_services_about',
		'title' => 'Секция c описание',
		'fields' => [
			[
				'key' => 'field_services_about_label',
				'label' => 'Надзаголовок',
				'name' => 'services_about_label',
				'type' => 'text'
			],
			[
				'key' => 'field_services_about_title',
				'label' => 'Заголовок',
				'name' => 'services_about_title',
				'type' => 'text'
			],
			[
				'key' => 'field_services_about_descr',
				'label' => 'Описание',
				'name' => 'services_about_descr',
				'type' => 'wysiwyg',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-services.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_services_directions',
		'title' => 'Секция "Что входит в сервисную поддержку"',
		'fields' => [
			[
				'key' => 'field_services_directions_label',
				'label' => 'Надзаголовок',
				'name' => 'services_directions_label',
				'type' => 'text'
			],
			[
				'key' => 'field_services_directions_title',
				'label' => 'Заголовок',
				'name' => 'services_directions_title',
				'type' => 'text'
			],
			[
				'key' => 'field_services_directions_list',
				'label' => 'Список направлений',
				'name' => 'services_directions_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_services_directions_list_title',
				'button_label' => 'Добавить направление',
				'sub_fields' => [
					[
						'key' => 'field_services_directions_list_icon',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
						'return_format' => 'array',
						'instructions' => 'Рекомендуется SVG'
					],
					[
						'key' => 'field_services_directions_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_services_directions_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-services.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_services_benefits',
		'title' => 'Секция "Преимущества сервиса"',
		'fields' => [
			[
				'key' => 'field_services_benefits_label',
				'label' => 'Надзаголовок',
				'name' => 'services_benefits_label',
				'type' => 'text'
			],
			[
				'key' => 'field_services_benefits_title',
				'label' => 'Заголовок',
				'name' => 'services_benefits_title',
				'type' => 'text'
			],
			[
				'key' => 'field_services_benefits_list',
				'label' => 'Список преимуществ',
				'name' => 'services_benefits_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_services_benefits_list_title',
				'button_label' => 'Добавить преимущество',
				'sub_fields' => [
					[
						'key' => 'field_services_benefits_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_services_benefits_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-services.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_services_process',
		'title' => 'Секция "Этапы сервисной поддержки"',
		'fields' => [
			[
				'key' => 'field_services_process_label',
				'label' => 'Надзаголовок',
				'name' => 'services_process_label',
				'type' => 'text'
			],
			[
				'key' => 'field_services_process_title',
				'label' => 'Заголовок',
				'name' => 'services_process_title',
				'type' => 'text'
			],
			[
				'key' => 'field_services_process_list',
				'label' => 'Список этапов',
				'name' => 'services_process_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_services_process_list_title',
				'button_label' => 'Добавить этап',
				'sub_fields' => [
					[
						'key' => 'field_services_process_list_title',
						'label' => 'Заголовок этапа',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_services_process_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-services.php'
				]
			]
		],
		'menu_order' => 4,
	]);
	// for-suppliers
	acf_add_local_field_group([
		'key' => 'group_suppliers_about',
		'title' => 'Секция "О поставщиках"',
		'fields' => [
			[
				'key' => 'field_suppliers_about_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_about_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_about_descr',
				'label' => 'Описание',
				'name' => 'suppliers_about_descr',
				'type' => 'wysiwyg',
			],
			[
				'key' => 'field_suppliers_about_image',
				'label' => 'Изображение',
				'name' => 'suppliers_about_image',
				'type' => 'image',
				'instructions' => 'Декоративное изображение секции'
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 2,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_cooperation',
		'title' => 'Секция "Сотрудничество с поставщиками"',
		'fields' => [
			[
				'key' => 'field_suppliers_cooperation_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_cooperation_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_cooperation_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_cooperation_title',
				'type' => 'textarea',
				'rows' => 2,
				'new_lines' => 'br'
			],
			[
				'key' => 'field_suppliers_cooperation_image',
				'label' => 'Изображение',
				'name' => 'suppliers_cooperation_image',
				'type' => 'image',
				'instructions' => 'Декоративное изображение секции'
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 3,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_why_us',
		'title' => 'Секция "Почему выбирают нас (поставщики)"',
		'fields' => [
			[
				'key' => 'field_suppliers_why_us_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_why_us_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_why_us_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_why_us_title',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_why_us_list',
				'label' => 'Список преимуществ',
				'name' => 'suppliers_why_us_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_suppliers_why_us_list_title',
				'button_label' => 'Добавить преимущество',
				'sub_fields' => [
					[
						'key' => 'field_suppliers_why_us_list_image',
						'label' => 'Иконка',
						'name' => 'image',
						'type' => 'image',
					],
					[
						'key' => 'field_suppliers_why_us_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'br'
					],
				],
			],
			[
				'key' => 'field_suppliers_why_us_note',
				'label' => 'Примечание внизу',
				'name' => 'suppliers_why_us_note',
				'type' => 'wysiwyg',
				'instructions' => 'Дополнительный текст под списком'
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 4,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_offer',
		'title' => 'Секция "Коммерческое предложение"',
		'fields' => [
			[
				'key' => 'field_suppliers_offer_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_offer_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_offer_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_offer_title',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_offer_list',
				'label' => 'Список пунктов предложения',
				'name' => 'suppliers_offer_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_suppliers_offer_list_title',
				'button_label' => 'Добавить пункт',
				'sub_fields' => [
					[
						'key' => 'field_suppliers_offer_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_suppliers_offer_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 3,
						'new_lines' => 'wpautop'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 5,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_expectations',
		'title' => 'Секция "Наши ожидания от поставщиков"',
		'fields' => [
			[
				'key' => 'field_suppliers_expectations_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_expectations_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_expectations_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_expectations_title',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_expectations_list',
				'label' => 'Список ожиданий',
				'name' => 'suppliers_expectations_list',
				'type' => 'repeater',
				'layout' => 'block',
				'collapsed' => 'field_suppliers_expectations_list_title',
				'button_label' => 'Добавить пункт',
				'sub_fields' => [
					[
						'key' => 'field_suppliers_expectations_list_image',
						'label' => 'Иконка',
						'name' => 'image',
						'type' => 'image',
						'return_format' => 'array',
						'instructions' => 'Рекомендуется SVG'
					],
					[
						'key' => 'field_suppliers_expectations_list_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'br'
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 6,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_market',
		'title' => 'Секция "Рынок поставщиков"',
		'fields' => [
			[
				'key' => 'field_suppliers_market_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_market_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_market_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_market_title',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_market_list',
				'label' => 'Список пунктов',
				'name' => 'suppliers_market_list',
				'type' => 'repeater',
				'layout' => 'table',
				'collapsed' => 'field_suppliers_market_list_descr',
				'button_label' => 'Добавить пункт',
				'sub_fields' => [
					[
						'key' => 'field_suppliers_market_list_descr',
						'label' => 'Описание',
						'name' => 'descr',
						'type' => 'textarea',
						'rows' => 2,
						'new_lines' => 'wpautop',
						'column_width' => '100'
					],
				],
			],
			[
				'key' => 'field_suppliers_market_image',
				'label' => 'Изображение (Desktop)',
				'name' => 'suppliers_market_image',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => 'Изображение для десктопной версии'
			],
			[
				'key' => 'field_suppliers_market_image_mobile',
				'label' => 'Изображение (Mobile)',
				'name' => 'suppliers_market_image_mobile',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => 'Изображение для мобильной версии. Если не заполнено, будет использовано десктопное.'
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 7,
	]);
	acf_add_local_field_group([
		'key' => 'group_suppliers_footer',
		'title' => 'Секция "Подвал + Контакты"',
		'fields' => [
			[
				'key' => 'field_suppliers_footer_label',
				'label' => 'Надзаголовок',
				'name' => 'suppliers_footer_label',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_footer_title',
				'label' => 'Заголовок',
				'name' => 'suppliers_footer_title',
				'type' => 'text'
			],
			[
				'key' => 'field_suppliers_footer_message',
				'label' => 'Инструкция',
				'type' => 'message',
				'message' => '<b>Чтобы изменить контакты</b>, перейдите в Панель управления сайтом > Редактирования контента > Основные секции > Контактные данные. <a href="' . admin_url('/admin.php?page=opt-contacts') . '" target="_blank">Перейти</a><br/>'
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-for-suppliers.php'
				]
			]
		],
		'menu_order' => 8,
	]);
}
