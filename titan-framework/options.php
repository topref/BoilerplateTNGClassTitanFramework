<?php
function my_theme_create_options() {
    // Инициализация фреймворка
    $titan = TitanFramework::getInstance('my-theme');

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
		    'name' => 'My Upload Option',
		    'id' => 'my_upload_option',
		    'type' => 'upload',
		    'desc' => 'Upload your image'
		)
	);

    // Создание опций для админ панели
    $generaltab->createOption(array(
	        'name' => 'My Text Option',
	        'id' => 'my_text_option',
	        'type' => 'text',
	        'desc' => 'This is our option'
	    )
    );

    $generaltab->createOption(array(
	        'name' => 'My Select Option',
	        'id' => 'my_select_option',
	        'type' => 'select',
	        'options' => array(
	            '1' => 'Option one',
	            '2' => 'Option two',
	            '3' => 'Option three',
	        ),
	        'desc' => 'This is a select drop down box',
	        'default' => '2',
	    )
    );

    $generaltab->createOption(array(
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