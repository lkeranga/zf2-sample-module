<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */
namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;

class PropertyMappingService implements ServiceInterface
{
    /**
     * @var \Property\Repository\PropertyMappingRepository
     */
    private $propertyMappingRepository;

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }


    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function create($data)
    {

    return $this->propertyMappingRepository->create($data);

    }

    //Create Permanant Property after approved



    //Get Pending Property By Extranet Admin



    public function fetch($id)
    {
        // TODO: Implement fetch() method.
    }

    public function checkExistProperty($data){

       return $this->propertyMappingRepository->checkExistProperty($data);
    }

    public function setPropertyMappingRepository($propertyMappingRepository)
    {

        return $this->propertyMappingRepository = $propertyMappingRepository;

    }



    public function delete($id)
    {
        // TODO: Implement delete() method.
    }



}