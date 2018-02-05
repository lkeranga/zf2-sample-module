<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


class Facility
{

    /**
     * @var String
     */
    private $prty_property_facility_id;

    /**
     * @var String
     */
    private $prty_property_id;

    /**
     * @var String
     */
    private $mstr_facility_id;

    /**
     * @var String
     */
    private $display_name;

    /**
     * @var String
     */
    private $status;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * @var Integer
     */
    private $created_by;

    /**
     * @var Integer
     */
    private $updated_by;

    /**
     * @var String
     */
    private $facility_name;

    /**
     * @var Integer
     */
    private $category_id;

    /**
     * @var String
     */
    private $category_name;


    /**
     * @return String
     */
    public function getPrtyPropertyFacilityId()
    {
        return $this->prty_property_facility_id;
    }

    /**
     * @param String $prty_property_facility_id
     */
    public function setPrtyPropertyFacilityId($prty_property_facility_id)
    {
        $this->prty_property_facility_id = $prty_property_facility_id;
    }

    /**
     * @return String
     */
    public function getPrtyPropertyId()
    {
        return $this->prty_property_id;
    }

    /**
     * @param String $prty_property_id
     */
    public function setPrtyPropertyId($prty_property_id)
    {
        $this->prty_property_id = $prty_property_id;
    }

    /**
     * @return String
     */
    public function getMstrFacilityId()
    {
        return $this->mstr_facility_id;
    }

    /**
     * @param String $mstr_facility_id
     */
    public function setMstrFacilityId($mstr_facility_id)
    {
        $this->mstr_facility_id = $mstr_facility_id;
    }

    /**
     * @return String
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @param String $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

    /**
     * @return String
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param String $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param int $created_by
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return int
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @param int $updated_by
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return mixed
     */
    public function getFacilityName()
    {
        return $this->facility_name;
    }

    /**
     * @param mixed $facility_name
     */
    public function setFacilityName($facility_name)
    {
        $this->facility_name = $facility_name;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return String
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param String $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

}