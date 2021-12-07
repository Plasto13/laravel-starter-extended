<?php

return [
    'name' => 'Core',
    'admin-prefix' => 'admin',

    'middleware' => [
        'backend' => [
            'web', 'auth', 'can:view_backend'
        ],
        'frontend' => [
        ],
        'api' => [
            'api',
        ],
    ],
];
