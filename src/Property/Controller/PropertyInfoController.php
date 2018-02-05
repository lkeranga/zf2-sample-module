<?php

namespace Property\Controller;

use Application\Controller\AbstractRestfulJsonController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PropertyInfoController extends AbstractRestfulJsonController
{
    public function create($data)
    {


        $response = [];

        try {
            $userdata = $this->getAuthService()->getUserIdFromToken();


            if ($userdata['userGroupId'] != 3) {

                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'You cannot Access for Property Creation';

            } else {

                $propertySerial = $this->getSerialService()->getCode('TMPPRTY');

                $data['prty_property_code'] = $propertySerial;
                $data['created_by'] = $userdata['userId'];
                $data['status'] = 0;
                $data['hotel_group_id'] = $userdata['hotelGroupId'];
                $data['hotel_chain_id'] = $userdata['hotelChainId'];
                $data['is_reject'] = 0;
                $data['is_approved'] = 0;
                $data['created_at'] = date('Y-m-d H:i:s');
                $property = $this->getPropertyInfoService()->create($data);

                if ($property == 1) {

                    $propertySerial = $this->getSerialService()->increment('TMPPRTY');
                }


                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = ($property == 1 ? 'Property has been created.' : 'Property has not been created.');
            }


        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }


        return new JsonModel($response);
    }

    // Get Pending Property Request by Extranet Admin
    public function getPendingRequestAction()
    {

        $response = [];
        try {
            $userdata = $this->getAuthService()->getUserIdFromToken();

            if ($userdata['userGroupId'] == 1) {
                $property = $this->getPropertyInfoService()->getPendingProperty();


                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = (!empty($property) ? 'Pending property list' : ' No Data found');
            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }
        return new JsonModel($response);
    }

    public function getPendingPropertyByIdAction()
    {

        try {
            $tempPropertyId = $this->params()->fromRoute('id');
            $userdata = $this->getAuthService()->getUserIdFromToken();

            if ($userdata['userGroupId'] == 1) {
                $property = $this->getPropertyInfoService()->getPendingPropertyById($tempPropertyId);

                $hotelGroupId = $property['hotel_group_id'];
                $hotelChainId = $property['hotel_chain_id'];

                $hotelChainData = $this->getHotelChainService()->getHotelChainByID($hotelChainId);


                $hotelGroupData = $this->getHotelGroupService()->getHotelGroupByID($hotelGroupId);


                if (!empty($hotelChainData)) {

                    $property['chain_info'] = $hotelChainData;
                }

                if (!empty($hotelGroupData)) {

                    $property['group_info'] = $hotelGroupData;
                }


                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = (!empty($property) ? 'Property Details' : ' No Data found');
            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }
        return new JsonModel($response);
    }

    public function mapPropertyAction()
    {

        try {

            $userdata = $this->getAuthService()->getUserIdFromToken();


            if ($userdata['userGroupId'] == 1) {

                if ($this->request->isPost()) {

                    $post = $this->request->getPost();

                    $tmpPropertyId = $post['tmp_property_id'];

                    unset($post['tmp_property_id']);

                    $checkMapping = $this->getPropertyMapService()->checkExistProperty((array)$post);

                    if ($checkMapping > 0) {
                        $response['success'] = false;
                        $response['data'] = null;
                        $response['message'] = 'Already mapped';

                        return new JsonModel($response);
                    }

                    $post['created_by'] = $userdata['userId'];
                    $post['created_at'] = date('Y-m-d H:i:s');
                    $post['status'] = 1;

                    $result = $this->getPropertyMapService()->create((array)$post);

//                    after Mapping the Property Updating Mapping status in Tmpery property table

                    $mapStatusUpdate = $this->getPropertyInfoService()->mappingStatusUpdate($tmpPropertyId);

                    if ($result > 0) {
                        $response['success'] = true;
                        $response['data'] = null;
                        $response['message'] = 'Property has been mapping';
                    }

                }


            }


        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);
    }

    public function approvePendingPropertyAction()
    {

        try {

            $tempPropertyId = $this->params()->fromRoute('id');

            $tmpProperty = $this->getTmpPropertyById($tempPropertyId);


            $userdata = $this->getAuthService()->getUserIdFromToken();


            if (!empty($tmpProperty)) {
                $tmpData = $tmpProperty;

                $approvResult = $this->getPropertyInfoService()->approvePendingProperty($tempPropertyId);


                if ($approvResult == 0) {

                    $response['success'] = false;
                    $response['data'] = null;
                    $response['message'] = 'Already Approved';

                    return new JsonModel($response);

                }


                $tmpData['prty_property_code'] = $this->getSerialService()->getCode('PRTY');

                $tmpData['created_by'] = $userdata['userId'];
                $tmpData['status'] = 1;


                $result = $this->getPropertyInfoService()->createProperty($tmpData);

                if ($result == 1) {

                    $data = [];
                    $data['created_by'] = $userdata['userId'];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['property_id'] = $tmpData['prty_property_code'];
                    $data['hotel_group_id'] = $tmpProperty['hotel_group_id'];
                    $data['hotel_chain_id'] = $tmpProperty['hotel_chain_id'];
                    $data['status'] = 1;

                    $resultMapping = $this->getPropertyMapService()->create($data);


                    $this->getSerialService()->increment('PRTY');

                    $response['success'] = true;
                    $response['data'] = null;
                    $response['message'] = ($result) ? 'Property has been Approved' : ' Error Occured';
                }


            } else {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Can not Find Property';
            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);


    }

    //Get Mapped property by chain admin
    public function getMapPropertyAction()
    {

        $response = [];
        try {
            $userdata = $this->getAuthService()->getUserIdFromToken();

            if ($userdata['userGroupId'] == 3) {

                $chainId = $userdata['hotelChainId'];
                $property = $this->getPropertyInfoService()->getMapProperty($chainId);

                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = 'Property Data';

            } else {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Access Denied';
            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);

    }


    //Internal Function

    public function getTmpPropertyById($id)
    {
        $property = $this->getPropertyInfoService()->getPendingPropertyById($id);

        return $property;
    }


    public function rejectPendingPropertyAction()
    {

        $response = [];
        try {

            $tempPropertyId = $this->params()->fromRoute('id');


            if (!empty($tempPropertyId)) {


                $rejectResult = $this->getPropertyInfoService()->rejectPendingProperty($tempPropertyId);


                if ($rejectResult == 0) {

                    $response['success'] = false;
                    $response['data'] = null;
                    $response['message'] = 'Already Reject';

                    return new JsonModel($response);

                }


                $response['success'] = true;
                $response['data'] = null;
                $response['message'] = ($rejectResult) ? 'Property has been Rejected' : ' Error Occured';


            }

        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);


    }

    public function delete($id)
    {

    }

    public function deleteList($data)
    {

    }

    public function get($id)
    {
        $response = [];

        try {

            $userdata = $this->getAuthService()->getUserIdFromToken();

            if ($userdata['userGroupId'] == 1) {

                $property = $this->getPropertyInfoService()->fetch($id);

                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = 'Property Data';

            } else {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Access Denied';
            }


        } catch (\Exception $e) {
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);
    }

    public function getList()
    {
        try {
            $response = [];

            $userdata = $this->getAuthService()->getUserIdFromToken();


            if ($userdata['userGroupId'] == 1) {
                $property = $this->getPropertyInfoService()->fetchAll();

                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = (!empty($property) ? 'Property list' : ' No Data found');

            }
        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }


        return new JsonModel($response);
    }

    public function head($id = null)
    {

    }

    public function options()
    {

    }

    public function patch($id, $data)
    {

    }

    public function replaceList($data)
    {

    }

    public function patchList($data)
    {

    }

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


            $userdata = $this->getAuthService()->getUserIdFromToken();


            if ($userdata['userGroupId'] == 4) {

                $propertyId = $userdata['propertyId'];

                $insert = false;
                foreach ($data as $languageCode => $property) {

                    if ($languageCode == "EN") {
                        unset($property['property_name']);
                        unset($property['address']);
                        unset($property['city_town']);
                        unset($property['postal_code']);
                        unset($property['longitude']);
                        unset($property['latitude']);
                        unset($property['latitude']);

                    }

                    $RecordCheckArray = [
                        'language_code' => $languageCode,
                        'prty_property_code' => $propertyId,
                    ];

                    $checkExist = $this->getPropertyInfoService()->checkPropertyRecord($RecordCheckArray);


                    if ($checkExist > 0) {
                        $property['updated_by'] = $userdata['userId'];
                        $property['updated_at'] = date('Y-m-d h:i:s');

                        $updateProperty = $this->getPropertyInfoService()->update($property, $RecordCheckArray);

                        if ($updateProperty) {
                            $insert = true;
                        }

                    } else {

//                        Create Service

                        $property['prty_property_code'] = $propertyId;
                        $property['created_by'] = $userdata['userId'];
                        $property['updated_by'] = $userdata['userId'];
                        $property['created_at'] = date('Y-m-d h:i:s');
                        $property['updated_at'] = date('Y-m-d h:i:s');
                        $property['status'] = 1;
                        $property['language_code'] = $languageCode;

                        $createProperty = $this->getPropertyInfoService()->createLanguageProperty($property);

                        if ($updateProperty) {
                            $insert = true;
                        }
                    }


                }

                if ($insert == true) {
                    $response['success'] = true;
                    $response['data'] = [];
                    $response['message'] = 'Property has been updated';
                }

            }

        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = [];
            $response['message'] = $e->getMessage();
        }
        return new JsonModel($response);

    }


    public function getMyPropertyAction()
    {

        $response = [];
        try {

            $userdata = $this->getAuthService()->getUserIdFromToken();

            if ($userdata['userGroupId'] == 4) {
                $propertyId = $userdata['propertyId'];


                $property = $this->getPropertyInfoService()->fetch($propertyId);

                $response['success'] = true;
                $response['data'] = $property;
                $response['message'] = (!empty($property) ? 'Property Data' : ' No Data found');

            }

        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();
        }

        return new JsonModel($response);

    }

    public function languageSetupAction()
    {

        $response = [];
        try {

            $userdata = $this->getAuthService()->getUserIdFromToken();


            if ($this->request->isPost()) {

                $post = $this->request->getPost();


                $checkExistLanguage = $this->getPropertyLanguageService()->fetch($userdata['propertyId']);

                if (count($checkExistLanguage) > 0) {

                    $deletePropertyLanguage = $this->getPropertyLanguageService()->delete($userdata['propertyId']);
                }

                $post['created_by'] = $userdata['userId'];
                $post['created_at'] = date('Y-m-d h:i:s');
                $post['prty_property_id'] = $userdata['propertyId'];

                $result = $this->getPropertyLanguageService()->create($post);


                $response['success'] = $result['success'];
                $response['data'] = null;
                $response['message'] = $result['msg'];

            }
        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);
    }


    public function getPropertyLanguageByIdAction()
    {

        $response = [];
        try {

            $propertyId = $this->params()->fromRoute('id');

            $language = $this->getPropertyLanguageService()->fetch($propertyId);

            $response['success'] = (!empty($language)) ? true : false;
            $response['data'] = (!empty($language)) ? $language : null;
            $response['message'] = (!empty($language)) ? 'Property Language Data' : 'No data found';

        } catch (\Exception $e) {

            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $e->getMessage();

        }

        return new JsonModel($response);


    }

    /**
     * @return  \Property\Service\PropertyInfoService
     */
    public function getPropertyInfoService()
    {

        return $this->getServiceLocator()->get('Property\Service\PropertyInfo');
    }

    public function getSerialService()
    {
        return $this->getServiceLocator()->get('MasterData\Service\Serial');
    }


    public function getAuthService()
    {
        return $this->getServiceLocator()->get('OAuth\Authentication\AuthenticationService');
    }

    public function getHotelChainService()
    {
        return $this->getServiceLocator()->get('Users\Service\HotelChain');
    }

    public function getHotelGroupService()
    {
        return $this->getServiceLocator()->get('Users\Service\HotelGroup');
    }


    public function getPropertyMapService()
    {
        return $this->getServiceLocator()->get('Property\Service\PropertyMapping');

    }

    public function getPropertyLanguageService()
    {
        return $this->getServiceLocator()->get('Property\Service\PropertyLanguage');

    }


}

