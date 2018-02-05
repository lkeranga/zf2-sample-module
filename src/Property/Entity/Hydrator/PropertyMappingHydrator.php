<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\PropertyMapping;
use Property\Entity\TempProperty;
use Zend\Hydrator\HydratorInterface;

class PropertyMappingHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof PropertyMapping) {
            return array();
        }

        return array(
            'id' =>$object ->getId(),
            'hotel_group_id' =>$object ->getHotelGroupId(),
            'hotel_chain_id' =>$object ->getHotelChainId(),
            'property_id' =>$object ->getPropertyId(),
            'status' =>$object ->getStatus(),
            'created_by' =>$object ->getCreatedBy(),
            'updated_by' =>$object ->getUpdatedBy(),
            'created_at' =>$object ->getCreatedAt(),
            'updated_at' =>$object ->getUpdatedAt(),

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
        if (!$object instanceof PropertyMapping) {
            return array();
        }


        $object->setId((isset($data['id']) ? $data['id'] : null));
        $object->setHotelGroupId((isset($data['hotel_group_id']) ? $data['hotel_group_id'] : null));
        $object->setHotelChainId((isset($data['hotel_chain_id']) ? $data['hotel_chain_id'] : null));
        $object->setPropertyId((isset($data['property_id']) ? $data['property_id'] : null));
        $object->setStatus((isset($data['status']) ? $data['status'] : null));
        $object->setCreatedBy((isset($data['created_by']) ? $data['created_by'] : null));
        $object->setUpdatedBy((isset($data['updated_by']) ? $data['updated_by'] : null));
        $object->setCreatedAt((isset($data['created_at']) ? $data['created_at'] : null));
        $object->setUpdatedAt((isset($data['updated_at']) ? $data['updated_at'] : null));


        return $object;
    }
}