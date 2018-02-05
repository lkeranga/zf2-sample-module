<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\Hydrator\PropertyMappingHydrator;
use Property\Entity\PropertyMapping;
use Property\Entity\TempProperty;
use Property\Entity\Hydrator\TempPropertyHydrator;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Aggregate\AggregateHydrator;

use \Zend\Db\Sql\Sql as ZendSql;

class PropertyMappingRepository implements RepositoryInterface
{

    use AdapterAwareTrait;

    private $table = 'prty_group_chain_property_mapping';
    private $primary_key = 'id';


    private $hydrator;

    public function fetch($id)
    {
        // TODO: Implement fetch() method.
    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    private $entity;

    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        //$this->hydrator = new MealTypeHydrator();
        // $this->entity = new MealType();
    }


    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function create($data)
    {


        $sql = new ZendSql($this->adapter);
        $insert = $sql->insert()
            ->values($data)
            ->into($this->table);

        $statement = $sql->prepareStatementForSqlObject($insert);

        return $statement->execute()->getAffectedRows();
    }

    public function checkExistProperty($data){

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from($this->table)
            ->where($data);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PropertyMappingHydrator());

        $resultSet = new HydratingResultSet($hydrator, new PropertyMapping());
        $resultSet->initialize($results);

        return $resultSet->count();

    }




}