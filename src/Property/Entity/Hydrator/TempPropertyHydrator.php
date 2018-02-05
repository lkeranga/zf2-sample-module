<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity\Hydrator;


use Property\Entity\TempProperty;
use Zend\Hydrator\HydratorInterface;

class TempPropertyHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof TempProperty) {
            return array();
        }

        return array(
            'prty_property_code' => $object->getPrtyPropertyCode(),
            'property_name' => $object->getPropertyName(),
            'description' => $object->getDescription(),
            'address' => $object->getAddress(),
            'city_town' => $object->getCityTown(),
            'postal_code' => $object->getPostalCode(),
            'country' => $object->getCountry(),
            'longitude' => $object->getLongitude(),
            'latitude' => $object->getLatitude(),
            'telephone' => $object->getTelephone(),
            'fax' => $object->getFax(),
            'email' => $object->getEmail(),
            'website' => $object->getWebsite(),
            'check_in_time' => $object->getCheckInTime(),
            'check_out_time' => $object->getCheckOutTime(),
            'status' => $object->getStatus(),
            'is_reject' => $object->getIsReject(),
            'is_approved' => $object->getIsApproved(),
            'hotel_group_id' => $object->getHotelGroupId(),
            'hotel_chain_id' => $object->getHotelChainId(),
            'created_by' => $object->getCreatedBy(),
            'updated_by' => $object->getUpdatedBy(),
            'language_code' => $object->getLanguageCode(),

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
        if (!$object instanceof TempProperty) {
            return array();
        }


        $object->setPrtyPropertyCode((isset($data['prty_property_code']) ? $data['prty_property_code'] : null));
            $object->setPropertyName((isset($data['property_name']) ? $data['property_name'] : null));
            $object->setDescription((isset($data['description']) ? $data['description'] : null));
            $object->setAddress((isset($data['address']) ? $data['address'] : null));
            $object->setCityTown((isset($data['city_town']) ? $data['city_town'] : null));
            $object->setPostalCode((isset($data['postal_code']) ? $data['postal_code'] : null));
            $object->setCountry((isset($data['country']) ? $data['country'] : null));
            $object->setLongitude((isset($data['longitude']) ? $data['longitude'] : null));
            $object->setLatitude((isset($data['latitude']) ? $data['latitude'] : null));
            $object->setTelephone((isset($data['telephone']) ? $data['telephone'] : null));
            $object->setFax((isset($data['fax']) ? $data['fax'] : null));
            $object->setEmail((isset($data['email']) ? $data['email'] : null));
            $object->setWebsite((isset($data['website']) ? $data['website'] : null));
            $object->setCheckInTime((isset($data['check_in_time']) ? $data['check_in_time'] : null));
            $object->setCheckOutTime((isset($data['check_out_time']) ? $data['check_in_time'] : null));
            $object->setStatus((isset($data['status']) ? $data['status'] : null));
            $object->setIsReject((isset($data['is_reject']) ? $data['is_reject'] : null));
            $object->setIsApproved((isset($data['is_approved']) ? $data['is_approved'] : null));
            $object->setHotelGroupId((isset($data['hotel_group_id']) ? $data['hotel_group_id'] : null));
            $object->setHotelChainId((isset($data['hotel_chain_id']) ? $data['hotel_chain_id'] : null));
            $object->setCreatedBy((isset($data['created_by']) ? $data['created_by'] : null));
            $object->setUpdatedBy((isset($data['updated_by']) ? $data['updated_by'] : null));
            $object->setLanguageCode((isset($data['language_code']) ? $data['language_code'] : null));


        return $object;
    }
}