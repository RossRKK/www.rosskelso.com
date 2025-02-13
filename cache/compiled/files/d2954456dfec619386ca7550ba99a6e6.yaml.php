<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/config/site.yaml',
    'modified' => 1739466212,
    'size' => 303,
    'data' => [
        'title' => 'Ross Kelso',
        'default_lang' => 'en',
        'author' => [
            'name' => 'Ross Kelso',
            'email' => 'ross@rosskelso.com'
        ],
        'taxonomies' => [
            0 => 'category',
            1 => 'tag'
        ],
        'metadata' => NULL,
        'summary' => [
            'enabled' => true,
            'format' => 'short',
            'size' => 300,
            'delimiter' => '==='
        ],
        'redirects' => [
            '/foundry' => 'https://foundry.rosskelso.com'
        ],
        'routes' => NULL,
        'blog' => [
            'route' => '/blog'
        ]
    ]
];
