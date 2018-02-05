<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */


namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\ChildInfo;
use Property\Entity\Hydrator\ChildInfoHydrator;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Aggregate\AggregateHydrator;

use \Zend\Db\Sql\Sql as ZendSql;

class ChildInfoRepository implements RepositoryInterface
{
    use AdapterAwareTrait;

    private $table = 'prty_child_info';
    private $primary_key = 'prty_property_id';

    private $hydrator;
    private $entity;

    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new ChildInfoHydrator();
        $this->entity = new ChildInfo();
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


}