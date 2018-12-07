<?php

namespace PlayOff;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\PlayOffController::class => Factory\PlayOffControllerFactory::class,
            Controller\PlayOffAjaxController::class => Factory\PlayOffAjaxControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'PlayOff\Service\playOffServiceInterface' => 'PlayOff\Service\playOffService',
            'PlayOff\Service\playOffTypeServiceInterface' => 'PlayOff\Service\playOffTypeService',
        ],
    ],
    // The following section is new and should be added to your file
    'router' => [
        'routes' => [
            'playoffs' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/playoffs[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PlayOffController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'playoffajax' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/playoff-ajax[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PlayOffAjaxController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'playoff' => __DIR__ . '/../view',
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            \PlayOff\Controller\PlayOffController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+playoff.manage']
            ],
            \PlayOff\Controller\PlayOffAjaxController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+playoff.manage']
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
