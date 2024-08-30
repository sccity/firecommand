<?php
return [
    'menu' => [
        [
            'icon' => 'fa fa-fire',
            'title' => 'Fire Command',
            'url' => '/FireCommand/calls',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/FireCommand/calls',
                    'title' => 'Active Calls',
                    'route-name' => 'fc-calls',
                ]
            ],
        ],
    ],
];