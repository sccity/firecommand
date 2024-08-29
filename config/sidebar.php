<?php
return [
    'menu' => [
        [
            'icon' => 'fa fa-sitemap',
            'title' => 'Fire Command',
            'url' => '/activecalls',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/activecalls',
                    'title' => 'Active Calls',
                    'route-name' => 'activecalls', // Ensure this matches your route name
                ]
            ],
        ],
    ],
];