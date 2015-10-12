<?php

/**
 * Description of AttractionHelper
 * Helper containing functions to set and get attraction methos
 * @author Naman <naman.bakliwal@optimusinfo.com>
 */

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Model\CountryTable;
use Application\Model\CityTable;
use Application\Model\AttractionTable;

class AttractionHelper {

    protected $error = array();

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $attraction = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($attraction)) {
            $this->setAttraction($attraction);
        }
    }

    public function setAttraction(Attraction $attraction) {
        $this->attraction = $attraction;
        return $this;
    }

    // Function to set form data
    public function setAttrFormData($data, $attraction, $logedInUserId) {
        if ($data['attractionImage']['name'] != '') {
            $attraction->setAttractionImage($data ['attractionImage'] ['name']);
        }
        $attraction->setAttrName($data ['attraction']);
        $attraction->setAttrPostalCode($data ['pin-code']);
        $attraction->setAttrCityIdFk($data ['city']);
        $attraction->setAttrCountryIdFk($data ['country-id']);
        $attraction->setUserIdFk($logedInUserId);
        $attraction->setAttrRating($data ['rating']);
        $attraction->setAttrUrl($data ['url']);
        $attraction->setAttrAddress($data ['address']);
        $attraction->setAttrDuration($data ['duration']);
        $attraction->setAttrDetails($data ['details']);
        $attraction->setAttrLastModifiedTime($data ['last_modified_time']);
        return $attraction;
    }

    // Function to return sorted and serach result
    public function getAjaxResult($attrSortValue, $attrName, $userRole, $userId) {
        $attractionTable = $this->serviceLocator->get('AttractionTable');
        if ($userRole == 'Travel Agent') {
            if ($attrSortValue == - 1) {
                $attraction = $attractionTable->getMany(array('tpod_attr_status' => 1, 'tpod_attr_usr_id_fk' => $userId))->toArray();
            } else if ($attrSortValue != null) {
                $attraction = $attractionTable->getMany(array(
                            'tpod_attr_city_id_fk' => $attrSortValue,
                            'tpod_attr_usr_id_fk' => $userId,
                            'tpod_attr_status' => 1,
                        ))->toArray();
            } else {
                $attraction = $attractionTable->getMany(array(
                            'tpod_attr_name' => $attrName,
                            'tpod_attr_status' => 1,
                            'tpod_attr_usr_id_fk' => $userId
                        ))->toArray();
            }
        } else {
            if ($attrSortValue == - 1) {
                $attraction = $attractionTable->getMany(array('tpod_attr_status' => 1))->toArray();
            } else if ($attrSortValue != null) {
                $attraction = $attractionTable->getMany(array(
                            'tpod_attr_city_id_fk' => $attrSortValue,
                            'tpod_attr_status' => 1
                        ))->toArray();
            } else {
                $attraction = $attractionTable->getMany(array(
                            'tpod_attr_name' => $attrName,
                            'tpod_attr_status' => 1
                        ))->toArray();
            }
        }
        return $attraction;
    }

    /*
     * Function to return result
     * on ajax call of onclick of pagination
     */

    public function getAjaxPaginationResult($attrSortValue, $attrName, $pageNo, $userRole, $userId) {
        $attractionTable = $this->serviceLocator->get('AttractionTable');
        if ($userRole == 'Admin') {
            if ($attrSortValue == - 1) {
                $attraction = $attractionTable->getPaginationResult(array('tpod_attr_status' => 1), array(), $pageNo)->toArray();
            } else if ($attrSortValue != null) {
                $attraction = $attractionTable->getPaginationResult(array(
                            'tpod_attr_city_id_fk' => $attrSortValue,
                            'tpod_attr_status' => 1
                                ), array(), $pageNo)->toArray();
            } else {
                $attraction = $attractionTable->getPaginationResult(array(
                            'tpod_attr_name' => $attrName,
                            'tpod_attr_status' => 1
                                ), array(), $pageNo)->toArray();
            }
        } elseif ($userRole == 'Travel Agent') {
            if ($attrSortValue == - 1) {
                $attraction = $attractionTable->getPaginationResult(array('tpod_attr_status' => 1, 'tpod_attr_usr_id_fk' => $userId), array(), $pageNo)->toArray();
            } else if ($attrSortValue != null) {
                $attraction = $attractionTable->getPaginationResult(array(
                            'tpod_attr_city_id_fk' => $attrSortValue,
                            'tpod_attr_usr_id_fk' => $userId,
                            'tpod_attr_status' => 1
                                ), array(), $pageNo)->toArray();
            } else {
                $attraction = $attractionTable->getPaginationResult(array(
                            'tpod_attr_name' => $attrName,
                            'tpod_attr_usr_id_fk' => $userId,
                            'tpod_attr_status' => 1
                                ), array(), $pageNo)->toArray();
            }
        }

        return $attraction;
    }

    /*
     * Get attraction image to edit
     */

    public function getAttractionImage($id) {
        $attractionTable = $this->serviceLocator->get('AttractionTable');
        $attraction = $attractionTable->getOne(array(
            'tpod_attr_id' => $id
        ));
        return $attractionImage = $attraction->getAttractionImage();
    }

    /*
     * Save form data for edit and add action
     * Arguments are form data, attraction object and image upload path
     */

    public function saveFormData($data, $attraction, $imgUpload, $logedInUserId) {

        $attractionTable = $this->serviceLocator->get('AttractionTable');
        $data ['last_modified_time'] = time();
        $data ['duration'] = $data ['hour'] . ':' . $data ['min'];
        if ($data['attractionImage']['name'] != '') {
            $imgUpload->setDestination(APPLICATION_PUBLIC_PATH . '/upload/Attraction');
            $imgUpload->receive($data ['attractionImage'] ['name']);
        }
        $parsed = parse_url($data ['url']);
        if (empty($parsed['scheme'])) {
            $data ['url'] = 'http://' . ltrim($data ['url'], '/');
        }
        $attraction = $this->setAttrFormData($data, $attraction, $logedInUserId);
        $attractionTable->save($attraction);
    }

    /*
     * Function to get city list to render in edit form
     */

    public function getCity($id) {
        $attraction = $this->getAttractionObject($id);
        $cityId = $attraction->getAttrCityIdFk();
        $cityTable = $this->serviceLocator->get('CityTable');
        $cityName = "";
        if ($cityId != 0) {
            $city = $cityTable->getOne(array(
                'tpod_city_id' => $cityId
            ));
            return $city;
        }
    }

    /*
     * Function to get country list to render in edit form
     */

    public function getCountry($id) {
        $attraction = $this->getAttractionObject($id);
        $countryId = $attraction->getAttrCountryIdFk();
        $countryTable = $this->serviceLocator->get('CountryTable');
        $countryName = "";
        if ($countryId != 0) {
            $country = $countryTable->getOne(array(
                'tpod_country_id' => $countryId
            ));
            return $country;
        }
    }

    /*
     * Function to get attraction  object
     */

    public function getAttractionObject($id) {
        $attractionTable = $this->serviceLocator->get('AttractionTable');
        $attraction = $attractionTable->getOne(array(
            'tpod_attr_id' => $id
        ));
        return $attraction;
    }

    /*
     * Function to save  attraction by api
     */

    public function setUtilityData($response, $attraction, $attrName, $cityIdFk, $countryIdFk) {

        $attraction->setAttrName($attrName);
        $attraction->setAttrPostalCode($response->address_obj->postalcode);
        $attraction->setAttrLatitude($response->latitude);
        $attraction->setAttrLongitude($response->longitude);
        $attraction->setAttrRating($response->rating);
        if ($response->wikipedia_info != null) {
            $attraction->setAttrUrl($response->wikipedia_info->url);
        }
        $attraction->setAttrCityIdFk($cityIdFk);
        $attraction->setAttrCountryIdFk($countryIdFk);
        return $attraction;
    }

}
