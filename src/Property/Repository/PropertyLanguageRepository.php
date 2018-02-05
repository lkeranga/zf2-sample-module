<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Repository;

use Application\Repository\RepositoryInterface;
use Property\Entity\Hydrator\PropertyLanguageHydrator;
use Property\Entity\PropertyLanguage;
use Property\Entity\TempProperty;
use Property\Entity\Hydrator\TempPropertyHydrator;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Aggregate\AggregateHydrator;

use \Zend\Db\Sql\Sql as ZendSql;

class PropertyLanguageRepository implements RepositoryInterface
{

    use AdapterAwareTrait;

    private $table = 'prty_language';


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
        // TODO: Implement update() method.
    }

    public function create($data)
    {

        $response = [];
        try {

            //            Begin Transaction
            $connection = $this->adapter->getDriver()->getConnection();
            $connection->beginTransaction();

            $this->updateLanguageConfig($data['prty_property_id']);

            $sql = new ZendSql($this->adapter);
            $insert = $sql->insert()
                ->values($data)
                ->into($this->table);

            $statement = $sql->prepareStatementForSqlObject($insert);


             $statement->execute()->getAffectedRows();
            $connection->commit();

            $response['success'] = true;
            $response['data'] = null;
            $response['msg'] = 'Language setup has been created';

        } catch (\Exception $e) {
            if ($connection instanceof \Zend\Db\Adapter\Driver\ConnectionInterface) {
                $connection->rollback();

                $response['success'] = false;
                $response['data'] = null;
                $response['msg'] = $e->getMessage();
            }
        }

        return $response;
    }

    public function updateLanguageConfig($propertyId)
    {

        $sql = new ZendSql($this->adapter);
        $query = $sql->update('property_config')
            ->set(['language_setup' => 1])
            ->where(array(
                'prty_property_id' => $propertyId,
            ));

        $statement = $sql->prepareStatementForSqlObject($query);

        return $statement->execute()->getAffectedRows();
    }


    public function fetch($id)
    {

        $sql = new ZendSql($this->adapter);

        $select = $sql->select();
        $select->columns(array('*'))
            ->from('prty_language')
            ->where(array(
                'prty_property_id' => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PropertyLanguageHydrator());

        $resultSet = new HydratingResultSet($hydrator, new PropertyLanguage());
        $resultSet->initialize($results);


        return $resultSet;
    }

    public function fetchAll()
    {


    }

    public function delete($id)
    {
        $sql = new ZendSql($this->adapter);
        $delete = $sql->delete()
            ->from('prty_language')
            ->where(array(
                'prty_property_id' => $id,
            ));

        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();

        return $result->getAffectedRows();
    }


}