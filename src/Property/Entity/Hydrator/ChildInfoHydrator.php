<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\ChildInfo;
use Zend\Hydrator\HydratorInterface;

class ChildInfoHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof ChildInfo) {
            return array();
        }

        return array(
            'prty_child_info_id' => $object->getPrtyChildInfoId(),
            'prty_property_id' => $object->getPrtyPropertyId(),
            'min_child_age' => $object->getMinChildAge(),
            'max_child_age' => $object->getMaxChildAge(),
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
        if (!$object instanceof ChildInfo) {
            return array();
        }

        $object->setPrtyChildInfoId(isset($data['prty_child_info_id']) ? $data['prty_child_info_id'] : null);
        $object->setPrtyPropertyId(isset($data['prty_property_id']) ? $data['prty_property_id'] : null);
        $object->setMinChildAge(isset($data['min_child_age']) ? $data['min_child_age'] : null);
        $object->setMaxChildAge(isset($data['max_child_age']) ? $data['max_child_age'] : null);
        $object->setCreatedAt(isset($data['created_at']) ? $data['created_at'] : null);
        $object->setUpdatedAt(isset($data['updated_at']) ? $data['updated_at'] : null);
        $object->setCreatedBy(isset($data['created_by']) ? $data['created_by'] : null);
        $object->setUpdatedBy(isset($data['updated_by']) ? $data['updated_by'] : null);

        return $object;
    }
}