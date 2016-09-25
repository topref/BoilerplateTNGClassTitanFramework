<?php
function my_theme_create_options() {
    // Инициализация фреймворка
    $titan = TitanFramework::getInstance('radial');

    // Создание админ панели
    $panel = $titan->createAdminPanel(array(
        	'name' => 'Theme Options',
    	)
    );

    // Создание таба с опциями
    $generaltab = $panel->createTab(array(
	    'name' => 'General Tab',
		)
	);

	$generaltab->createOption(array(
		    'name' => 'Логотип сайта',
		    'id' => 'logo',
		    'type' => 'upload',
		    'desc' => 'Загрузите логотип для сайта'
		)
	);

    // Создание опций для админ панели
    $generaltab->createOption(array(
	        'name' => 'Телефон',
	        'id' => 'tel1',
	        'type' => 'text',
	        'desc' => 'Телефон для контактов.'
	    )
    );

    $generaltab->createOption(array(
            'name' => 'Телефон',
            'id' => 'tel2',
            'type' => 'text',
            'desc' => 'Телефон для контактов.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Телефон',
            'id' => 'tel3',
            'type' => 'text',
            'desc' => 'Телефон для контактов.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Контакты',
            'id' => 'contact',
            'type' => 'textarea',
            'desc' => 'Укажите адрес для сайта.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Копирайт',
            'id' => 'copy',
            'type' => 'text',
            'desc' => 'Укажите копирайты для сайта.'
        )
    );

    $generaltab->createOption( array(
            'name' => 'Социальные сети',
            'type' => 'heading',
        )
    );

    $generaltab->createOption(array(
            'name' => 'FaceBook',
            'id' => 'fb',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в FaceBook.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Twitter',
            'id' => 'tw',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в Twitter.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Google+',
            'id' => 'google',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в Google+.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Instagramm',
            'id' => 'inst',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в Instagramm.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Вконтакте',
            'id' => 'vk',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в Вконтакте.'
        )
    );

    $generaltab->createOption(array(
            'name' => 'Одноклассники',
            'id' => 'ok',
            'type' => 'text',
            'desc' => 'Добавьте ссылку на профиль в Одноклассники.'
        )
    );

//    $generaltab->createOption(array(
//	        'name' => 'My Select Option',
//	        'id' => 'my_select_option',
//	        'type' => 'select',
//	        'options' => array(
//	            '1' => 'Option one',
//	            '2' => 'Option two',
//	            '3' => 'Option three',
//	        ),
//	        'desc' => 'This is a select drop down box',
//	        'default' => '2',
//	    )
//    );

    $generaltab->createOption(array(
            'save' => 'Сохранить',
            'reset' => 'Сбросить',
			'type' => 'save'
		)
    );

    // Создание второго таба для опций
    $Tab2 = $panel->createTab(array(
		    'name' => 'Tab 2',
		    'desc' => 'Описание вкладки'
		)
	);

	$Tab2->createOption(array(
		    'name' => 'My Editor Option',
		    'id' => 'my_editor_option',
		    'type' => 'editor',
		    'desc' => 'Put your footer content here'
		)
	);

	$Tab2->createOption(array(
		    'name' => 'Post Categories',
		    'id' => 'my_categories_option',
		    'type' => 'select-categories',
		    'desc' => 'This is an option'
		)
	);

	$Tab2->createOption(array(
	        'type' => 'save'
	    )
    );


}