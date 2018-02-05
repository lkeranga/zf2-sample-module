<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\PropertyLanguage;

use Zend\Hydrator\HydratorInterface;

class PropertyLanguageHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof PropertyLanguage) {
            return array();
        }

        return array(
            'prty_language_id' => $object->getPrtyLanguageId(),
            'prty_property_id' => $object->getPrtyPropertyId(),
            'language_code' => $object->getLanguageCode(),
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
        if (!$object instanceof PropertyLanguage) {
            return array();
        }


        $object->setPrtyLanguageId((isset($data['prty_language_id']) ? $data['prty_language_id'] : null));
        $object->setPrtyPropertyId((isset($data['prty_property_id']) ? $data['prty_property_id'] : null));
        $object->setLanguageCode((isset($data['language_code']) ? $data['language_code'] : null));
       $object->setCreatedBy((isset($data['created_by']) ? $data['created_by'] : null));
        $object->setUpdatedBy((isset($data['updated_by']) ? $data['updated_by'] : null));
        $object->setCreatedAt((isset($data['created_at']) ? $data['created_at'] : null));
        $object->setUpdatedAt((isset($data['updated_at']) ? $data['updated_at'] : null));


        return $object;
    }
}