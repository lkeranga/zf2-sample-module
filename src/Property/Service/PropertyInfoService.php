<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */
namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;

class PropertyInfoService implements ServiceInterface
{
    /**
     * @var \Property\Repository\PropertyInfoRepository
     */
    private $propertyRepository;


    public function update($data, $id)
    {
       return $this->propertyRepository->update($data,$id);
    }

    public function createLanguageProperty($property){

        return $this->propertyRepository->createLanguageProperty($property);
    }


    public function mappingStatusUpdate($tmpPropertyId){

        return $this->propertyRepository->mappingStatusUpdate($tmpPropertyId);
    }

    public function create($data)
    {
        $propertyName = $data['property_name'][0]['data'];

        $description = $data['description'][0]['data'];

        unset($data['property_name']);
        unset($data['description']);

        $data['property_name'] = $propertyName;
        $data['description'] = $description;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['language_code'] = 'EN';
        $data['status'] = 0;

        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            return $this->propertyRepository->create($data);
        } else {
            return $validate->getErrors();
        }


    }

    //Create Permanant Property after approved

    public function createProperty($data){

        $propertyName = $data['property_name'][0]->data;

        $description = $data['description'][0]->data;

        unset($data['property_name']);
        unset($data['description']);
        unset($data['is_reject']);
        unset($data['is_approved']);
        unset($data['hotel_group_id']);
        unset($data['hotel_chain_id']);


        $data['property_name'] = $propertyName;
        $data['description'] = $description;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['language_code'] = 'EN';
        $data['status'] = 1;


        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            return $this->propertyRepository->createProperty($data);
        } else {
            return $validate->getErrors();
        }
    }

    //Get Pending Property By Extranet Admin

    public function getPendingProperty()
    {

        return $this->propertyRepository->getPendingProperty()->toArray();
    }

    public function approvePendingProperty($tempPropertyId)
    {

        return $this->propertyRepository->approvePendingProperty($tempPropertyId);
    }

    public function rejectPendingProperty($tempPropertyId)
    {

        return $this->propertyRepository->rejectPendingProperty($tempPropertyId);
    }

    public function getMapProperty($chainId){

        return $this->propertyRepository->getMapProperty($chainId);
    }

    public function getPendingPropertyById($tempPropertyId)
    {

        $property = $this->propertyRepository->getPendingPropertyById($tempPropertyId)->toArray();
        if (!empty($property)) {
            $property = $property[0];
            $propertyName = $property['property_name'];
            $property['property_name'] = '';
            $property['property_name'][0] = new \stdClass();
            $property['property_name'][0]->language_code = 'EN';
            $property['property_name'][0]->data = $propertyName;

            $description = $property['description'];
            $property['description'] = '';
            $property['description'][0] = new \stdClass();
            $property['description'][0]->language_code = 'EN';
            $property['description'][0]->data = $description;

            return $property;
        } else {


            return $property;

        }


    }

    public function checkPropertyRecord($RecordCheckArray){

        return $this->propertyRepository->checkPropertyRecord($RecordCheckArray);
    }

    public function fetch($id)
    {
       return $this->propertyRepository->fetch($id)->toArray();
    }

    public function fetchEn($id)
    {
        return $this->propertyRepository->fetchEn($id)->toArray();
    }

    public function setPropertyRepository($propertyInfoRepository)
    {

        return $this->propertyRepository = $propertyInfoRepository;
    }

    public function fetchAll()
    {
        return $this->propertyRepository->fetchAll()->toArray();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return array
     */
    public function getValidator()
    {
        return array(
            'property_name' => array(
                'label' => 'Property Name',
                'required' => true
            )
        );
    }

}