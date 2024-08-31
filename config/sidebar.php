<?php
return [
    'menu' => [
        [
            'icon' => 'fa fa-desktop',
            'title' => 'Mobile Data Command',
            'url' => '/comingsoon',
            'route-name' => 'mdc'
        ],
        [
            'icon' => 'fa fa-fire',
            'title' => 'Incident Command',
            'url' => '/ic/calls',
            'route-name' => 'fc-calls'
        ],
        [
            'icon' => 'fa fa-building',
            'title' => 'Incident Planning',
            'url' => '/comingsoon',
            'route-name' => 'preplan'
        ],
        [
            'icon' => 'fa fa-plane',
            'title' => 'DroneCAD',
            'url' => '/comingsoon',
            'route-name' => 'dronecad'
        ],
        [
            'icon' => 'fa fa-gear',
            'title' => 'Spillman Automation',
            'url' => '/comingsoon',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/comingsoon',
                    'title' => 'Agency Setup',
                    'route-name' => 'sa-agency',
                ],
                [
                    'url' => '/comingsoon',
                    'title' => 'Natures',
                    'route-name' => 'sa-nature',
                ],
                [
                    'url' => '/comingsoon',
                    'title' => 'City Setup',
                    'route-name' => 'sa-city',
                ],
            ],
        ],
    ],
];