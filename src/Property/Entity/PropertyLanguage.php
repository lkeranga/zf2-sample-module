<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Entity;


use phpDocumentor\Reflection\Types\String_;
use Zend\Db\Sql\Ddl\Column\Decimal;
use Zend\Form\Element\DateTime;


class PropertyLanguage
{

    /**
     * @var int
     */
    private $prty_language_id;

    /**
     * @var String
     */
    private $prty_property_id;

    /**
     * @var String
     */
    private $language_code;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * @var int
     */
    private $created_by;
    /**
     * @var int
     */
    private $updated_by;

    /**
     * @return int
     */
    public function getPrtyLanguageId()
    {
        return $this->prty_language_id;
    }

    /**
     * @param int $prty_language_id
     */
    public function setPrtyLanguageId($prty_language_id)
    {
        $this->prty_language_id = $prty_language_id;
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
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * @param String $language_code
     */
    public function setLanguageCode($language_code)
    {
        $this->language_code = $language_code;
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