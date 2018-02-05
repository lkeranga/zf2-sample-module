<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Service;

use Application\Service\ServiceInterface;
use Application\Utility\Validator;

class FacilityService implements ServiceInterface
{
    /**
     * @var \Property\Repository\FacilityRepository
     */
    private $facilityRepository;

    /**
     * @param \Property\Repository\FacilityRepository $facilityRepository
     */
    public function setFacilityRepository($facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->facilityRepository->update($data, $id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            return $this->facilityRepository->create($data);
        } else {
            return $validate->getErrors();
        }

    }


    /**
     * @param $data
     * @return array|bool|mixed
     */
    public function save($data)
    {
        $validate = new Validator($data, $this->getValidator());

        if ($validate->getErrors() === false) {
            $property_id = $data['prty_property_id'];

            $this->update(['status' => false], $property_id);

            if (is_array($data['mstr_facility_id'])) {
                $facilities = $data['mstr_facility_id'];
                foreach ($facilities as $mst_facility_id) {
                    $data['mstr_facility_id'] = $mst_facility_id;

                    $is_exists = $this->facilityRepository->isExists(
                        ['prty_property_id' => $property_id, 'mstr_facility_id' => $mst_facility_id]
                    );

                    if (is_array($is_exists)) {
                        $data['status'] = true;
                        $data['prty_property_facility_id'] = $is_exists['prty_property_facility_id'];
                        $this->facilityRepository->save($data, $is_exists['prty_property_facility_id']);
                        unset($data['prty_property_facility_id']);
                    } else {
                        $this->create($data);
                    }
                }

                return true;
            } else {
                return false;
            }
        } else {
            return $validate->getErrors();
        }
    }

    /**
     * @return array
     */
    public function getValidator()
    {
        return array(
            'mstr_facility_id' => array(
                'label' => 'Facility Id',
                'required' => true
            ),
            'prty_property_id' => array(
                'label' => 'Property ID',
                'required' => true
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id)
    {
        return $this->facilityRepository->fetch($id);
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->facilityRepository->fetchAll();
    }

    /**
     * @return mixed
     */
    public function fetchAllJoined($id = null)
    {
        return $this->facilityRepository->fetchAllJoined($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->facilityRepository->delete($id);
    }

}