<?php

namespace Competition;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\SoftDeleteable\SoftDeleteableListener;

return [
    'controllers' => [
        'factories' => [
            Controller\CompetitionController::class => Factory\CompetitionControllerFactory::class,
            Controller\CompetitionAjaxController::class => Factory\CompetitionAjaxControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'Competition\Service\competitionServiceInterface' => 'Competition\Service\competitionService',
        ],
    ],
    // The following section is new and should be added to your file
    'router' => [
        'routes' => [
            'competitions' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/competitions[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CompetitionController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'competitionajax' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/competition-ajax[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CompetitionAjaxController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'competitions' => __DIR__ . '/../view',
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            \Competition\Controller\CompetitionController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+competition.manage']
            ],
            \Competition\Controller\CompetitionAjaxController::class => [
                // to anyone.
                ['actions' => '*', 'allow' => '+competition.manage']
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
        ],
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\SoftDeleteable\SoftDeleteableListener',
                ],
            ],
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
