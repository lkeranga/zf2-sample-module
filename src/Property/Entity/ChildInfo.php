<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


class ChildInfo
{
    /**
     * @var Integer
     */
    private $prty_child_info_id;

    /**
     * @var String
     */
    private $prty_property_id;

    /**
     * @var Integer
     */
    private $min_child_age;

    /**
     * @var Integer
     */
    private $max_child_age;

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
     * @return int
     */
    public function getPrtyChildInfoId()
    {
        return $this->prty_child_info_id;
    }

    /**
     * @param int $prty_child_info_id
     */
    public function setPrtyChildInfoId($prty_child_info_id)
    {
        $this->prty_child_info_id = $prty_child_info_id;
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
     * @return int
     */
    public function getMinChildAge()
    {
        return $this->min_child_age;
    }

    /**
     * @param int $min_child_age
     */
    public function setMinChildAge($min_child_age)
    {
        $this->min_child_age = $min_child_age;
    }

    /**
     * @return int
     */
    public function getMaxChildAge()
    {
        return $this->max_child_age;
    }

    /**
     * @param int $max_child_age
     */
    public function setMaxChildAge($max_child_age)
    {
        $this->max_child_age = $max_child_age;
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


}