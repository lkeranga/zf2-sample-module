<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */


namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\Facility;
use Property\Entity\Hydrator\FacilityHydrator;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql as ZendSql;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class FacilityRepository implements RepositoryInterface
{
    use AdapterAwareTrait;

    private $table = 'prty_property_facility';
    private $primary_key = 'prty_property_id';

    private $hydrator;
    private $entity;

    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new FacilityHydrator();
        $this->entity = new Facility();
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
                'prty_property_facility_id' => $id,
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
            ->from($this->table);

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
        return false;

        $sql = new ZendSql($this->adapter);
        $delete = $sql->delete()
            ->from($this->table)
            ->where(array(
                $this->primary_key => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($delete);
        return $statement->execute();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetchAllJoined($id = null)
    {
        $sql = new ZendSql($this->adapter);

        $hydrator = new AggregateHydrator();
        $hydrator->add($this->hydrator);

        $resultSet = new HydratingResultSet($hydrator, $this->entity);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from(array('t' => $this->table))
            ->join(
                array('f' => 'mstr_facility'),
                'f.id = t.mstr_facility_id',
                array(
                    'facility_name' => 'name',
                ),
                $select::JOIN_LEFT
            )
            ->join(
                array('fc' => 'mstr_facility_category'),
                'fc.id = f.category_id',
                array(
                    'category_name' => 'name',
                    'category_id' => 'id',
                ),
                $select::JOIN_LEFT
            );

        $select->where(array(
            't.prty_property_id' => $id,
            't.status' => 1
        ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $resultSet->initialize($results);

        return $resultSet;


    }


    /**
     * @param $where
     * @return bool
     */
    public function isExists($where)
    {
        $sql = new ZendSql($this->adapter);
        $select = $sql->select();
        $select->columns(array('*'))
            ->from($this->table)
            ->where($where);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add($this->hydrator);

        $resultSet = new HydratingResultSet($hydrator, $this->entity);
        $resultSet->initialize($results);

        return ($resultSet->count() > 0 ? $resultSet->toArray()[0] : null);
    }

}