<?php

 return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'admin_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Admin/Entity',
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Admin\Entity' => 'admin_entity'
                )
            )
        )
    ),

     'controllers' => array(
         'invokables' => array(
             'Admin\Controller\Index' => 'Admin\Controller\IndexController',
             'category' => 'Admin\Controller\CategoryController',
             'article' => 'Admin\Controller\ArticleController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'admin' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'category' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => 'category/[:action/][:id/]',
                            'defaults' => array(
                                'controller' => 'category',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'article' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => 'article/[:action/][:id/]',
                            'defaults' => array(
                                'controller' => 'article',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ), // << child_routes
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'admin' => __DIR__ . '/../view',
         ),
         'template_map' => array(
             'pagination_control' => __DIR__ . '/../view/layout/pagination_control.phtml',
         ),
     ),
 );