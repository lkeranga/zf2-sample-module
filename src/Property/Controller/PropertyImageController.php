<?php
/**
 * Copyright (c) Oganro (Pvt) Ltd. 2017. Extranet Booking System
 */

namespace Property\Controller;

use Application\Controller\AbstractRestfulJsonController;
use Application\Utility\Image;
use Zend\View\Model\JsonModel;

class PropertyImageController extends AbstractRestfulJsonController
{
    private $user_id;


    /**
     * Action used for GET requests without resource Id
     * @return JsonModel
     */
    public function getList()
    {
        $response = array();

        try {
            $response['success'] = true;

            $this->getPropertyImageService()->setPropertyId($this->getPropertyCode());

            $response['data'] = $this->getPropertyImageService()->fetchAll()->toArray();
            $response['message'] = (empty($response['data']) ? 'No Property Image has been found' : 'Property Image List');
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * @return  \Property\Service\PropertyImageService
     */
    public function getPropertyImageService()
    {
        return $this->getServiceLocator()->get('Property\Service\PropertyImage');
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
     * Action used for GET requests with resource Id
     * @param mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        $response = array();

        try {
            $response['success'] = true;

            $this->getPropertyImageService()->setPropertyId($this->getPropertyCode());

            $response['data'] = $this->getPropertyImageService()->fetch($id);
            $response['message'] = (empty($response['data']) ? 'No Property Image has been found' : 'Property Image List');
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

            if (isset($_FILES['image_path'])) {
                $uploader = new Image($_FILES['image_path']);
                $uploader->set_upload_to("images/property/" . $this->getPropertyCode());
                $uploader->set_valid_extensions(array('image/bmp', 'image/jpeg', 'image/png'), false);

                if ($uploader->is_valid_extension() === false) {
                    $response['success'] = true;
                    $response['data'] = null;
                    $response['message'] = 'File extension is not allowed.';
                } else {
                    if ($uploader->run() === false) {
                        $response['success'] = true;
                        $response['data'] = null;
                        $response['message'] = 'Failed to upload the file.';
                    } else {
                        $file_path = $uploader->uploaded_image;

                        $data['prty_property_id'] = $this->getPropertyCode();
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = $this->user_id;

                        $data['updated_at'] = date('Y-m-d H:i:s');
                        $data['updated_by'] = $this->user_id;
                        $data['status'] = true;

                        $data['image_path'] = $file_path;

                        $data = $this->getPropertyImageService()->hydrateData($data);
                        $save = $this->getPropertyImageService()->create($data);

                        $response['success'] = true;
                        $response['data'] = $save;
                        $response['message'] = ($save ? 'Property Image has been saved.' : 'Property Image has not been saved.');
                    }

                }
            } else {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Please upload a image.';
            }


        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * Action used for PUT requests
     * @param mixed $id
     * @param mixed $data
     * @return JsonModel
     */
    public function update($id, $data)
    {
        $response = array();

        // Manage Content Type for PUT request

        $content_type = $this->params()->fromHeader('Content-type', 'get');

        if ($content_type->getFieldValue() != 'application/x-www-form-urlencoded') {
            $response['success'] = false;
            $response['data'] = [];
            $response['message'] = 'Missing Content-Type application/x-www-form-urlencoded';
            return new JsonModel($response);
        }

        try {
            if (isset($id)) {
                $this->getPropertyImageService()->setPropertyId($this->getPropertyCode());
                $property_image = $this->getPropertyImageService()->fetch($id);

                if (count($property_image) == 1) {

                    $update_data['alt_tag'] = $data['alt_tag'];
                    $update_data['updated_at'] = date('Y-m-d H:i:s');
                    $update_data['updated_by'] = $this->user_id;
                    $update_data['status'] = $data['status'];

                    $update = $this->getPropertyImageService()->update($update_data, $id);

                    $response['success'] = true;
                    $response['data'] = [];
                    $response['message'] = ($update == 1 ? 'Property Image has been updated.' : 'Property Image has not been updated.');
                } else {
                    $response['success'] = false;
                    $response['data'] = [];
                    $response['message'] = 'Property Image code does not exist.';
                }
            } else {
                $response['success'] = false;
                $response['data'] = [];
                $response['message'] = 'Missing field Property Image Id.';
            }


        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    /**
     * @return /MasterData/Service/SerialService
     */
    public function getSerialService()
    {
        return $this->getServiceLocator()->get('MasterData\Service\Serial');
    }

    /**
     * Action used for DELETE requests
     * @param mixed $id
     * @return JsonModel
     */
    public function delete($id)
    {
        $this->getPropertyImageService()->setPropertyId($this->getPropertyCode());

        $delete = $this->getPropertyImageService()->delete($id);

        $response['success'] = true;
        $response['data'] = [];
        $response['message'] = ($delete == 1 ? 'Property Image has been deleted.' : 'Property Image has not been deleted.');

        return new JsonModel($response);

    }


}

