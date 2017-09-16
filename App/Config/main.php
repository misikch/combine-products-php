<?php

return [
    'environment' => 'dev', //'production'
    'commands' => [
        \App\Commands\CombineCommand::class,
    ],
    'databases' => [
        'csv' => [
            'file' => __DIR__ . '/../../storage/products.csv',
        ],
    ],
];