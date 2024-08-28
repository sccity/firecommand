<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
  'menu' => [[
		'icon' => 'fa fa-sitemap',
		'title' => 'Fire Command',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/activecalls',
			'title' => 'Active Calls',
			'route-name' => 'active-calls'
		]]
		
	]]
];
