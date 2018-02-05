<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Controller;

use Application\Controller\AbstractRestfulJsonController;
use Zend\View\Model\JsonModel;

class ChildInfoController extends AbstractRestfulJsonController
{
    private $user_id;

    /**
     * Action used for GET requests without resource Id
     * @return JsonModel
     */
    public function getList()
    {
        $this->getPropertyCode();
        $response = array();

        try {
            $response['success'] = true;
            $response['data'] = $this->getChildInfoService()->fetch($this->getPropertyCode());
            $response['message'] = (empty($response['data']) ? 'No Child Info has been found' : 'Child Info List');
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * @return Array
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
     * @return  \Property\Service\ChildInfoService
     */
    public function getChildInfoService()
    {
        return $this->getServiceLocator()->get('Property\Service\ChildInfo');
    }

    /**
     * Action used for GET requests with resource Id
     * @param mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        $response = array();

        try {
            if ($id != $this->getPropertyCode()) {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Unauthorized access to property ' . $id;
            } else {
                $response['success'] = true;
                $response['data'] = $this->getChildInfoService()->fetch($this->getPropertyCode());
                $response['message'] = (empty($response['data']) ? 'No Child Info found' : 'Child Info Details');
            }
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
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
            $child_info = $this->getChildInfoService()->fetch($this->getPropertyCode());

            if (count($child_info) == 0) {

                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->user_id;

                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by'] = $this->user_id;

                $save = $this->getChildInfoService()->create($data);

                $response['success'] = true;
                $response['data'] = $save;
                $response['message'] = ($save == 1 ? 'Child Info has been created.' : 'Child Info has not been created.');
            } else {

                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by'] = $this->user_id;

                $update = $this->getChildInfoService()->update($data, $this->getPropertyCode());

                $response['success'] = true;
                $response['data'] = [];
                $response['message'] = ($update == 1 ? 'Child Info has been updated.' : 'Child Info has not been updated.');
            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

}
