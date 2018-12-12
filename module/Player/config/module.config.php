<?php

namespace Player;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\PlayerController::class => Factory\PlayerControllerFactory::class,
            Controller\PlayerAjaxController::class => Factory\PlayerAjaxControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'Player\Service\playerServiceInterface' => 'Player\Service\playerService',
        ],
    ],
    // The following section is new and should be added to your file
    'router' => [
        'routes' => [
            'players' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/players[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PlayerController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'playerajax' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/player-ajax[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PlayerAjaxController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'players' => __DIR__ . '/../view',
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            \Player\Controller\PlayerController::class => [
                // to anyone.
                ['actions' => ['index', 'add', 'edit', 'delete'], 'allow' => '+player.manage'],
                ['actions' => ['editPlayer'], 'allow' => '@']

            ],
            \Player\Controller\PlayerAjaxController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+player.manage'],
            ],
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
];
