<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Controller;

use Application\Controller\AbstractRestfulJsonController;
use Zend\View\Model\JsonModel;

class FacilityController extends AbstractRestfulJsonController
{
    private $user_id;
    private $facility_prefix = 'PRTFAC';

    /**
     * Action used for GET requests without resource Id
     * @return JsonModel
     */
    public function getList()
    {
        $response = array();

        try {
            $response['success'] = true;
            $response['data'] = $this->getMasterDataFacilityService()->toGrouped($this->getFacilityService()->fetchAllJoined($this->getPropertyCode())->toArray());
            $response['message'] = (empty($response['data']) ? 'No Facility has been found' : 'Facility List');
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * @return  \Property\Service\FacilityService
     */
    public function getFacilityService()
    {
        return $this->getServiceLocator()->get('Property\Service\Facility');
    }

    /**
     * Action used for POST requests
     * @param mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        $response = array();

        try {
            $data['prty_property_id'] = $this->getPropertyCode();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->user_id;

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->user_id;
            $data['status'] = true;

            $data['prty_property_facility_id'] = $this->getSerialService()->getCode($this->facility_prefix);

            $save = $this->getFacilityService()->save($data);

            $response['success'] = true;
            $response['data'] = $save;
            $response['message'] = ($save ? 'Facility has been saved.' : 'Facility has not been saved.');

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * @return array
     */
    private function getPropertyCode()
    {
        $user_data = $this->getAuthService()->getUserIdFromToken();

        if (is_array($user_data)) {
            $this->user_id = $user_data['userId'];
            return $user_data['propertyId'];
        }
    }

    /**
     * @return /OAuth/Authentication/AuthenticationService
     */
    public function getAuthService()
    {
        return $this->getServiceLocator()->get('OAuth\Authentication\AuthenticationService');
    }

    /**
     * @return /MasterData/Service/SerialService
     */
    public function getSerialService()
    {
        return $this->getServiceLocator()->get('MasterData\Service\Serial');
    }

    /**
     * @return  \MasterData\Service\FacilityService
     */
    public function getMasterDataFacilityService()
    {
        return $this->getServiceLocator()->get('MasterData\Service\Facility');
    }


}

