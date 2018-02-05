<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */


namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\PropertyImage;
use Property\Entity\Hydrator\PropertyImageHydrator;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql as ZendSql;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class PropertyImageRepository implements RepositoryInterface
{
    use AdapterAwareTrait;

    private $table = 'prty_property_image';
    private $primary_key = 'prty_property_image_id';

    private $hydrator;
    private $entity;

    private $property_id;

    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new PropertyImageHydrator();
        $this->entity = new PropertyImage();
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        $sql = new ZendSql($this->adapter);
        $query = $sql->update($this->table)
            ->set($data)
            ->where(array(
                $this->primary_key => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($query);
        return $statement->execute()->getAffectedRows();
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function save($data, $id)
    {
        $sql = new ZendSql($this->adapter);
        $query = $sql->update($this->table)
            ->set($data)
            ->where(array(
                $this->primary_key => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($query);
        return $statement->execute()->getAffectedRows();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $sql = new ZendSql($this->adapter);
        $insert = $sql->insert()
            ->values($data)
            ->into($this->table);

        $statement = $sql->prepareStatementForSqlObject($insert);
        return $statement->execute()->getAffectedRows();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id)
    {
        $sql = new ZendSql($this->adapter);
        $select = $sql->select();
        $select->columns(array('*'))
            ->from($this->table)
            ->where(array(
                $this->primary_key => $id,
                'prty_property_id' => $this->property_id
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add($this->hydrator);

        $resultSet = new HydratingResultSet($hydrator, $this->entity);
        $resultSet->initialize($results);

        return ($resultSet->count() > 0 ? $resultSet->toArray() : null);
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from($this->table)
            ->where(array(
                'prty_property_id' => $this->property_id
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add($this->hydrator);

        $resultSet = new HydratingResultSet($hydrator, $this->entity);
        $resultSet->initialize($results);

        return $resultSet;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = new ZendSql($this->adapter);
        $delete = $sql->delete()
            ->from($this->table)
            ->where(array(
                $this->primary_key => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($delete);

        return $statement->execute()->getAffectedRows();

    }

    /**
     * @param mixed $property_id
     */
    public function setPropertyId($property_id)
    {
        $this->property_id = $property_id;
    }


}