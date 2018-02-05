<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


class PropertyImage
{
    /**
     * @var Integer
     */
    private $prty_property_image_id;

    /**
     * @var String
     */
    private $prty_property_id;

    /**
     * @var String
     */
    private $image_path;

    /**
     * @var String
     */
    private $alt_tag;

    /**
     * @var Boolean
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
     * @return int
     */
    public function getPrtyPropertyImageId()
    {
        return $this->prty_property_image_id;
    }

    /**
     * @param int $prty_property_image_id
     */
    public function setPrtyPropertyImageId($prty_property_image_id)
    {
        $this->prty_property_image_id = $prty_property_image_id;
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
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param String $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * @return String
     */
    public function getAltTag()
    {
        return $this->alt_tag;
    }

    /**
     * @param String $alt_tag
     */
    public function setAltTag($alt_tag)
    {
        $this->alt_tag = $alt_tag;
    }

    /**
     * @return bool
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
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


}