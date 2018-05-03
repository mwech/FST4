<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'FST4' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=s567507373.online.de;dbname=FST4',
                    'user'       => 'FST4',
                    'password'   => 'adminfst4',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'log' => [
                'defaultLogger' => [
                    'type' => 'stream',
                    'path' => '/var/log/propel.log',
                    'level' => 300
                ],
                'FST4' => [
                    'type' => 'stream',
                    'path' => '/var/log/propel_FST4.log',
                ]
            ]
        ],
        'generator' => [
            'defaultConnection' => 'FST4',
            'connections' => ['FST4']
        ]
    ]
];

