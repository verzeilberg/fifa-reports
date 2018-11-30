<?php

namespace Game;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\GameController::class => Factory\GameControllerFactory::class,
            Controller\GameAjaxController::class => Factory\GameAjaxControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'Game\Service\gameServiceInterface' => 'Game\Service\gameService',
        ],
    ],
    // The following section is new and should be added to your file
    'router' => [
        'routes' => [
            'games' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/games[/:action][/:competitionid][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GameController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'gameajax' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/game-ajax[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GameAjaxController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'games' => __DIR__ . '/../view',
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            \Game\Controller\GameController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+game.manage']
            ],
            \Game\Controller\GameAjaxController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '*']

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
