<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;
use Property\Entity\Hydrator\PropertyImageHydrator;
use Property\Entity\PropertyImage;

class PropertyImageService implements ServiceInterface
{
    /**
     * @var \Property\Repository\PropertyImageRepository
     */
    private $propertyImageRepository;

    /**
     * @param \Property\Repository\PropertyImageRepository $propertyImageRepository
     */
    public function setPropertyImageRepository($propertyImageRepository)
    {
        $this->propertyImageRepository = $propertyImageRepository;
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->propertyImageRepository->update($data, $id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            return $this->propertyImageRepository->create($data);
        } else {
            return $validate->getErrors();
        }

    }

    /**
     * @return array
     */
    public function getValidator()
    {
        return array(
            'image_path' => array(
                'label' => 'Image',
                'required' => true
            ),
            'alt_tag' => array(
                'label' => 'Alt Tag',
                'required' => true
            )
        );
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->propertyImageRepository->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $image_file = $this->fetch($id);

        if (is_array($image_file)) {
            $image_file = $image_file[0];
            if (@unlink(getcwd() . '/public' . $image_file['image_path'])) {
                return $this->propertyImageRepository->delete($id);
            }
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id)
    {
        return $this->propertyImageRepository->fetch($id);
    }

    /**
     * @param $property_id
     */
    public function setPropertyId($property_id)
    {
        $this->propertyImageRepository->setPropertyId($property_id);
    }

    /**
     * @param $data
     * @return array
     */
    public function hydrateData($data)
    {

        $hydrator = new PropertyImageHydrator();
        $propertyImage = $hydrator->hydrate($data, new PropertyImage());
        return $hydrator->extract($propertyImage);
    }
}