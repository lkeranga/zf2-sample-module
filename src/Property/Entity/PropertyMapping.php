<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


use phpDocumentor\Reflection\Types\String_;
use Zend\Db\Sql\Ddl\Column\Decimal;
use Zend\Form\Element\DateTime;


class PropertyMapping
{

    /**
     * @var int
     */
    private $id;

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
    private $property_id;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $created_by;

    /**
     * @var int
     */
    private $updated_by;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPropertyId()
    {
        return $this->property_id;
    }

    /**
     * @param String $property_id
     */
    public function setPropertyId($property_id)
    {
        $this->property_id = $property_id;
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







}