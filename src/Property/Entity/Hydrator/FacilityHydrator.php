<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\Facility;
use Zend\Hydrator\HydratorInterface;

class FacilityHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Facility) {
            return array();
        }

        return array(
            'prty_property_facility_id' => $object->getPrtyPropertyFacilityId(),
            'prty_property_id' => $object->getPrtyPropertyId(),
            'mstr_facility_id' => $object->getMstrFacilityId(),
//            'display_name' => $object->getDisplayName(),
            'status' => $object->getStatus(),
            'created_at' => $object->getCreatedAt(),
            'updated_at' => $object->getUpdatedAt(),
            'created_by' => $object->getCreatedBy(),
            'updated_by' => $object->getUpdatedBy(),
            'facility_name' => $object->getFacilityName(),
            'category_name' => $object->getCategoryName(),
            'category_id' => $object->getCategoryId(),
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
        if (!$object instanceof Facility) {
            return array();
        }

        $object->setPrtyPropertyFacilityId(isset($data['prty_property_facility_id']) ? $data['prty_property_facility_id'] : null);
        $object->setPrtyPropertyId(isset($data['prty_property_id']) ? $data['prty_property_id'] : null);
        $object->setMstrFacilityId(isset($data['mstr_facility_id']) ? $data['mstr_facility_id'] : null);
//        $object->setDisplayName(isset($data['display_name']) ? $data['display_name'] : null);
        $object->setStatus(isset($data['status']) ? $data['status'] : null);
        $object->setCreatedAt(isset($data['created_at']) ? $data['created_at'] : null);
        $object->setUpdatedAt(isset($data['updated_at']) ? $data['updated_at'] : null);
        $object->setCreatedBy(isset($data['created_by']) ? $data['created_by'] : null);
        $object->setUpdatedBy(isset($data['updated_by']) ? $data['updated_by'] : null);
        $object->setFacilityName(isset($data['facility_name']) ? $data['facility_name'] : null);
        $object->setCategoryName((isset($data['category_name']) ? $data['category_name'] : null));
        $object->setCategoryId((isset($data['category_id']) ? $data['category_id'] : null));

        return $object;
    }
}