<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

return array(
    'factories' => array(
        'Property\Service\PropertyInfo' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {


            // SET DATABASE ADEPTER
            $propertyInfoRepository = new \Property\Repository\PropertyInfoRepository();
            $propertyInfoRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $propertyinfoService = new \Property\Service\PropertyInfoService();
            $propertyinfoService->setPropertyRepository($propertyInfoRepository);

            return $propertyinfoService;
        },
        'Property\Service\PropertyMapping' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {


            // SET DATABASE ADEPTER
            $propertyMappingRepository = new \Property\Repository\PropertyMappingRepository();
            $propertyMappingRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $propertyMappingService = new \Property\Service\PropertyMappingService();
            $propertyMappingService->setPropertyMappingRepository($propertyMappingRepository);

            return $propertyMappingService;
        },

        'Property\Service\PropertyLanguage' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {


            // SET DATABASE ADEPTER
            $propertyLanguageRepository = new \Property\Repository\PropertyLanguageRepository();
            $propertyLanguageRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $propertyLanguageService = new \Property\Service\PropertyLanguageService();
            $propertyLanguageService->setPropertyLanguageRepository($propertyLanguageRepository);

            return $propertyLanguageService;
        },

        /** @author Praneeth Nidarshan */
        'Property\Service\ChildInfo' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {

            // SET DATABASE ADEPTER
            $childInfoRepository = new \Property\Repository\ChildInfoRepository();
            $childInfoRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $childInfoService = new \Property\Service\ChildInfoService();
            $childInfoService->setChildInfoRepository($childInfoRepository);

            return $childInfoService;

        },

        'Property\Service\Facility' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {

            // SET DATABASE ADEPTER
            $facilityRepository = new \Property\Repository\FacilityRepository();
            $facilityRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $facilityService = new \Property\Service\FacilityService();
            $facilityService->setFacilityRepository($facilityRepository);

            return $facilityService;

        },

        'Property\Service\PropertyImage' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {

            // SET DATABASE ADEPTER
            $propertyImageRepository = new \Property\Repository\PropertyImageRepository();
            $propertyImageRepository->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));

            // SET REPOSITORY
            $propertyImageService = new \Property\Service\PropertyImageService();
            $propertyImageService->setPropertyImageRepository($propertyImageRepository);

            return $propertyImageService;

        },
        /** @author Praneeth Nidarshan :: END */
    )
);
