<?php

return [
    '/' => [
        'name' => 'send',
        'callback' => '\Modules\Reviews\Controllers\ReviewController:index'
    ],
    '/{pk}' => [
        'name' => 'view',
        'callback' => '\Modules\Reviews\Controllers\ReviewController:view'
    ]
];