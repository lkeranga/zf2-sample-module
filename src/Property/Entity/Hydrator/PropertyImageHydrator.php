<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\PropertyImage;
use Zend\Hydrator\HydratorInterface;

class PropertyImageHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof PropertyImage) {
            return array();
        }

        return array(
            'prty_property_image_id' => $object->getPrtyPropertyImageId(),
            'prty_property_id' => $object->getPrtyPropertyId(),
            'image_path' => $object->getImagePath(),
            'alt_tag' => $object->getAltTag(),
            'status' => $object->isStatus(),
            'created_at' => $object->getCreatedAt(),
            'updated_at' => $object->getUpdatedAt(),
            'created_by' => $object->getCreatedBy(),
            'updated_by' => $object->getUpdatedBy(),
        );

    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof PropertyImage) {
            return array();
        }

        $object->setPrtyPropertyImageId(isset($data['prty_property_image_id']) ? $data['prty_property_image_id'] : null);
        $object->setPrtyPropertyId(isset($data['prty_property_id']) ? $data['prty_property_id'] : null);
        $object->setImagePath(isset($data['image_path']) ? $data['image_path'] : null);
        $object->setAltTag(isset($data['alt_tag']) ? $data['alt_tag'] : null);
        $object->setStatus(isset($data['status']) ? $data['status'] : null);
        $object->setCreatedAt(isset($data['created_at']) ? $data['created_at'] : null);
        $object->setUpdatedAt(isset($data['updated_at']) ? $data['updated_at'] : null);
        $object->setCreatedBy(isset($data['created_by']) ? $data['created_by'] : null);
        $object->setUpdatedBy(isset($data['updated_by']) ? $data['updated_by'] : null);

        return $object;
    }
}