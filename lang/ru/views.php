<?php

return [
    'home' => [
        'header' => 'Привет!',
        'description' => 'Это простой менеджер задач на Laravel',
        'learn_more' => 'Нажми меня'
    ],
    'task_status' => [
        'index' => [
            'header' => 'Статусы',
            'id' => 'ID',
            'name' => 'Имя',
            'created_at' => 'Дата создания',
            'actions' => 'Действия',
            'delete_confirmation' => 'Вы уверены?',
            'delete' => 'Удалить',
            'edit' => 'Изменить',
            'create_button' => 'Создать статус'
        ],
        'edit' => [
            'form_header' => 'Изменение статуса',
            'labels' => [
                'name' => 'Имя'
            ],
            'buttons' => [
                'update' => 'Обновить'
            ]
        ],
        'create' => [
            'form_header' => 'Создать статус',
            'labels' => [
                'name' => 'Имя'
            ],
            'buttons' => [
                'create' => 'Создать'
            ]
        ]
    ]
];
