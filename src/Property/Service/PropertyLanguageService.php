<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */
namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;

class PropertyLanguageService implements ServiceInterface
{
    /**
     * @var \Property\Repository\PropertyLanguageRepository
     */
    private $propertyLanguageRepository;



    public function setPropertyLanguageRepository($propertyLanguageRepository)
    {

        return $this->propertyLanguageRepository = $propertyLanguageRepository;
    }


    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function create($data)
    {
        if(!empty($data)){

            $propertyId = $data['prty_property_id'];

            foreach ($data['language_code'] as $key=>$value){
             $languageArray = [
               'prty_property_id' =>$propertyId,
               'language_code' =>$key,
               'created_at' =>$data['created_at'],
               'created_by' =>$data['created_by'],
             ];
             $result = $this->propertyLanguageRepository->create($languageArray);



            }

            if($result > 0){
                $response = [
                    'success' => true,
                    'msg' => 'Language has been setup'
                ];
            }else{
                $response = [
                    'success' => false,
                    'msg' => 'Language has not been setup'
                ];
            }

            return $response;
        }


    }

    public function fetch($id)
    {
        $result = $this->propertyLanguageRepository->fetch($id)->toArray();

        return $result;

    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    public function delete($id)
    {
       return $this->propertyLanguageRepository->delete($id);
    }
}