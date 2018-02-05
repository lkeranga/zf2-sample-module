<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\TempProperty;
use Property\Entity\Hydrator\TempPropertyHydrator;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Aggregate\AggregateHydrator;

use \Zend\Db\Sql\Sql as ZendSql;

class PropertyInfoRepository implements RepositoryInterface
{

    use AdapterAwareTrait;

    private $table = 'prty_property';
    private $primary_key = 'prty_property';


    private $hydrator;
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
        $sql = new ZendSql($this->adapter);
        $query = $sql->update($this->table)
            ->set($data)
            ->where($id);

        $statement = $sql->prepareStatementForSqlObject($query);

        return $statement->execute()->getAffectedRows();
    }

//    Create Property From Secondary Languages
    public function createLanguageProperty($property)
    {
        $sql = new ZendSql($this->adapter);
        $insert = $sql->insert()
            ->values($property)
            ->into($this->table);

        $statement = $sql->prepareStatementForSqlObject($insert);

        return $statement->execute()->getAffectedRows();

    }

    public function getMapProperty($chainId)
    {

        $sql = new ZendSql($this->adapter);
        $select = $sql->select();

        $select->columns(array())
            ->from(array('m' => 'prty_group_chain_property_mapping'))
            ->where(array(
                'm.hotel_chain_id' => $chainId

            ))
            ->join(
                array('p' => 'prty_property'),
                'p.prty_property_code = m.property_id',
                array(
                    'prty_property_code' => 'prty_property_code',
                    'property_name' => 'property_name',
                ),
                $select::JOIN_LEFT
            );

        $statement = $sql->prepareStatementForSqlObject($select);

        $results = $statement->execute();

        if (count($results) > 0) {
            $property = [];
            foreach ($results as $data) {

                array_push($property,
                    [
                        'property_code' => $data['prty_property_code'],
                        'name' => $data['property_name']
                    ]);
            }

            return $property;

        }


    }

    public function create($data)
    {


        $sql = new ZendSql($this->adapter);
        $insert = $sql->insert()
            ->values($data)
            ->into('prty_tmp_property');

        $statement = $sql->prepareStatementForSqlObject($insert);

        return $statement->execute()->getAffectedRows();
    }

    //Create Permanant Property
    public function createProperty($data)
    {

        $sql = new ZendSql($this->adapter);
        $insert = $sql->insert()
            ->values($data)
            ->into('prty_property');

        $statement = $sql->prepareStatementForSqlObject($insert);

        return $statement->execute()->getAffectedRows();

    }

//after Mapping the Property Updating Mapping status in Tmpery property table

    public function mappingStatusUpdate($tmpPropertyId)
    {

        $sql = new ZendSql($this->adapter);
        $query = $sql->update('prty_tmp_property')
            ->set(array('is_mapped' => 1))
            ->where(array('prty_property_code' => $tmpPropertyId));

        $statement = $sql->prepareStatementForSqlObject($query);

        return $statement->execute()->getAffectedRows();
    }


    public function getPendingProperty()
    {

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_tmp_property')
            ->where(array(
                'prty_tmp_property.is_reject' => 0,
                'prty_tmp_property.is_approved' => 0,
                'prty_tmp_property.is_mapped' => 0,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet;
    }


    public function approvePendingProperty($tempPropertyId)
    {


        $sql = new ZendSql($this->adapter);
        $query = $sql->update('prty_tmp_property')
            ->set(array('is_approved' => 1))
            ->where(array(
                'prty_property_code' => $tempPropertyId,
            ));

        $statement = $sql->prepareStatementForSqlObject($query);

        return $statement->execute()->getAffectedRows();
    }

    public function rejectPendingProperty($tempPropertyId)
    {


        $sql = new ZendSql($this->adapter);
        $query = $sql->update('prty_tmp_property')
            ->set(array('is_reject' => 1))
            ->where(array(
                'prty_property_code' => $tempPropertyId,
            ));

        $statement = $sql->prepareStatementForSqlObject($query);

        return $statement->execute()->getAffectedRows();
    }

    public function checkPropertyRecord($RecordCheckArray)
    {

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from($this->table)
            ->where($RecordCheckArray);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet->count();


    }


    public function getPendingPropertyById($tempPropertyId)
    {

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_tmp_property')
            ->where(array(
                'prty_tmp_property.prty_property_code' => $tempPropertyId,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet;

    }

    public function fetch($id)
    {
        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_property')
            ->where(array(
                'prty_property_code' => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet;
    }

    //get Property From Base Language

    public function fetchEn($id)
    {
        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_property')
            ->where(array(
                'prty_property_code' => $id,
                'language_code' => 'EN',
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet;
    }

    public function fetchAll()
    {

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_property')
            ->where(array(
                'status' => 1,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new TempPropertyHydrator());

        $resultSet = new HydratingResultSet($hydrator, new TempProperty());
        $resultSet->initialize($results);

        return $resultSet;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


}