<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


use phpDocumentor\Reflection\Types\String_;
use Zend\Db\Sql\Ddl\Column\Decimal;


class TempProperty
{

    /**
     * @var String
     */
    private $language_code;
    /**
     * @var String
     */
    private $country_code_iso;

    /**
     * @var String
     */
    private $prty_property_code;

    /**
     * @var String
     */
    private $property_name;

    /**
     * @var String
     */
    private $description;

    /**
     * @var String
     */
    private $address;

    /**
     * @var String
     */
    private $city_town;

    /**
     * @var String
     */
    private $postal_code;

    /**
     * @var String
     */
    private $country;

    /**
     * @var Decimal
     */
    private $longitude;

    /**
     * @var Decimal
     */
    private $latitude;

    /**
     * @var String
     */
    private $telephone;

    /**
     * @var String
     */
    private $fax;

    /**
     * @var String
     */
    private $email;

    /**
     * @var String
     */
    private $website;

    /**
     * @var String
     */
    private $check_in_time;

    /**
     * @var String
     */
    private $check_out_time;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $is_reject;

    /**
     * @var int
     */
    private $is_approved;

    /**
     * @var String
     */
    private $hotel_group_id;

    /**
     * @var String
     */
    private $hotel_chain_id;

    /**
     * @var String
     */
    private $created_by;

    /**
     * @var String
     */
    private $updated_by;

    /**
     * @return String
     */
    public function getCountryCodeIso()
    {
        return $this->country_code_iso;
    }

    /**
     * @param String $country_code_iso
     */
    public function setCountryCodeIso($country_code_iso)
    {
        $this->country_code_iso = $country_code_iso;
    }

    /**
     * @return String
     */
    public function getPrtyPropertyCode()
    {
        return $this->prty_property_code;
    }

    /**
     * @param String $prty_property_code
     */
    public function setPrtyPropertyCode($prty_property_code)
    {
        $this->prty_property_code = $prty_property_code;
    }

    /**
     * @return String
     */
    public function getPropertyName()
    {
        return $this->property_name;
    }

    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * @param mixed $language_code
     */
    public function setLanguageCode($language_code)
    {
        $this->language_code = $language_code;
    }

    /**
     * @param String $property_name
     */
    public function setPropertyName($property_name)
    {
        $this->property_name = $property_name;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param String $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return String
     */
    public function getCityTown()
    {
        return $this->city_town;
    }

    /**
     * @param String $city_town
     */
    public function setCityTown($city_town)
    {
        $this->city_town = $city_town;
    }

    /**
     * @return String
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param String $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @return String
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return Decimal
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param Decimal $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return Decimal
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param Decimal $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return String
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param String $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return String
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param String $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param String $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return String
     */
    public function getCheckInTime()
    {
        return $this->check_in_time;
    }

    /**
     * @param String $check_in_time
     */
    public function setCheckInTime($check_in_time)
    {
        $this->check_in_time = $check_in_time;
    }

    /**
     * @return String
     */
    public function getCheckOutTime()
    {
        return $this->check_out_time;
    }

    /**
     * @param String $check_out_time
     */
    public function setCheckOutTime($check_out_time)
    {
        $this->check_out_time = $check_out_time;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getIsReject()
    {
        return $this->is_reject;
    }

    /**
     * @param int $is_reject
     */
    public function setIsReject($is_reject)
    {
        $this->is_reject = $is_reject;
    }

    /**
     * @return int
     */
    public function getIsApproved()
    {
        return $this->is_approved;
    }

    /**
     * @param int $is_approved
     */
    public function setIsApproved($is_approved)
    {
        $this->is_approved = $is_approved;
    }

    /**
     * @return String
     */
    public function getHotelGroupId()
    {
        return $this->hotel_group_id;
    }

    /**
     * @param String $hotel_group_id
     */
    public function setHotelGroupId($hotel_group_id)
    {
        $this->hotel_group_id = $hotel_group_id;
    }

    /**
     * @return String
     */
    public function getHotelChainId()
    {
        return $this->hotel_chain_id;
    }

    /**
     * @param String $hotel_chain_id
     */
    public function setHotelChainId($hotel_chain_id)
    {
        $this->hotel_chain_id = $hotel_chain_id;
    }

    /**
     * @return String
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param String $created_by
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return String
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @param String $updated_by
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
    }






}