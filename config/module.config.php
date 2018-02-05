<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Users;


return array(

    'router' => array(
        'routes' => array(
            'api' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/api',
                ),
                // Defines that "/news" can be matched on its own without a child route being matched
                'may_terminate' => true,
                'child_routes' => array(

                    'property' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/property[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                            ),
                        ),
                    ),
                    'getPendingProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/get-pending-property',
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'getPendingRequest',
                            ),
                        ),
                    ),
                    'getPendingPropertyByID' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/get-pending-property-by-id[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'getPendingPropertyById',
                            ),
                        ),
                    ),
                    'approvePendingProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/approve-pending-property[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'approvePendingProperty',
                            ),
                        ),
                    ),

                    'rejectPendingProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/reject-pending-property[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'rejectPendingProperty',
                            ),
                        ),
                    ),
//                    property-language-setup
                    'mapProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/map-property',

                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'mapProperty',
                            ),
                        ),
                    ),

                    'getMapProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/get-map-property',

                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'getMapProperty',
                            ),
                        ),
                    ),
                    'propertylanguagesetup' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/property-language-setup',

                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'languageSetup',
                            ),
                        ),
                    ),
                    'getPropertyLanguage' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/get-property-language[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'getPropertyLanguageById',
                            ),
                        ),
                    ),
                    'getMyProperty' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/get-my-property',

                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyInfo',
                                'action' => 'getMyProperty',
                            ),
                        ),
                    ),

                    'child-info' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/child-info[/:id]',
                            'defaults' => array(
                                'controller' => 'Property\Controller\ChildInfo',
                            ),
                        ),
                    ),

                    'property-facility' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/property-facility[/:id]',
                            'defaults' => array(
                                'controller' => 'Property\Controller\Facility',
                            ),
                        ),
                    ),

                    'property-image' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/property-image[/:id]',
                            'defaults' => array(
                                'controller' => 'Property\Controller\PropertyImage',
                            ),
                        ),
                    ),
                )
            ),


        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Property\Controller\PropertyInfo' => 'Property\Controller\PropertyInfoController',
            'Property\Controller\ChildInfo' => 'Property\Controller\ChildInfoController',
            'Property\Controller\Facility' => 'Property\Controller\FacilityController',
            'Property\Controller\PropertyImage' => 'Property\Controller\PropertyImageController',
        ),
    ),

    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'display_not_found_reason' => true,
    ),
);
