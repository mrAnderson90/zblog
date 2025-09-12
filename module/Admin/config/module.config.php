<?php

 return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'admin_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    // __DIR__ . '/../src/Admin/Entity', // Раскомментировать, если появятся сущности
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    // 'Admin\Entity' => 'admin_entity' // Раскомментировать, если появятся сущности
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

     'service_manager' => array(
         'factories' => array(
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
             'admin_navigation' => 'Admin\Lib\AdminNavigationFactory',
         ),
     ),

     'navigation' => array(
         'default' => array(
             array(
                 'label' => '  Главная  ',
                 'route' => 'home',
             ),
         ),
         'admin_navigation' => array(
             array(
                 'label' => 'Панель управления сайтом',
                 'route' => 'admin',
                 'action' => 'index',
                 'resource' => 'Admin\Controller\Index',
                 'pages' => array(
                     array(
                         'label' => '  Статьи  ',
                         'route' => 'admin/article',
                         'action' => 'index',
                     ),
                     array(
                         'label' => '  Добавить статью  ',
                         'route' => 'admin/article',
                         'action' => 'add',
                     ),
                     array(
                         'label' => '  Категории  ',
                         'route' => 'admin/category',
                         'action' => 'index',
                     ),
                     array(
                         'label' => 'Добавить категорию',
                         'route' => 'admin/category',
                         'action' => 'add',
                     ),
//                     array(
//                         'label' => 'Комментарии',
//                         'route' => 'admin/comment',
//                         'action' => 'index',
//                     ),
                 ),
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