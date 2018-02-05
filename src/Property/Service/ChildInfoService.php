<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;

class ChildInfoService implements ServiceInterface
{
    /**
     * @var \Property\Repository\ChildInfoRepository
     */
    private $childInfoRepository;

    /**
     * @param \Property\Repository\ChildInfoRepository $childInfoRepository
     */
    public function setChildInfoRepository($childInfoRepository)
    {
        $this->childInfoRepository = $childInfoRepository;
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->childInfoRepository->update($data, $id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            return $this->childInfoRepository->create($data);
        } else {
            return $validate->getErrors();
        }

    }

    /**
     * @return array
     */
    public function getValidator()
    {
        return array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id)
    {
        return $this->childInfoRepository->fetch($id);
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->childInfoRepository->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->childInfoRepository->delete($id);
    }

}