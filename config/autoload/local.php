<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return [
    // Configuration for your SMTP server (for sending outgoing mail).
    'smtp' => [
        'name'              => 'localhost.localdomain',
        'host'              => '127.0.0.1',
        'port'              => 25,
        'connection_class'  => 'plain',
        'connection_config' => [
            'username' => '<user>',
            'password' => '<pass>',
        ],
    ],
    // Database connection configuration.
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => '172.19.4.82',
                    'port'     => '3306',
                    'user'     => 'usr_fifa',
                    'password' => 'JORuwoS1N8HAsi8ID7w6GiG75OF1zI',
                    'dbname'   => 'fifa-reports',
                ]
            ]
        ]
    ],
];
