<?php

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Model\CountryTable;
use Application\Model\TourTable;
use Application\Model\Tour;

/**
 * Description of ItineraryHelper
 *
 * @author TM
 */
class TourHelper {

    protected $error = array();

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $tour = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($tour)) {
            $this->setTour($tour);
        }
    }

    public function setTour(Tour $tour) {
        $this->tour = $tour;
        return $this;
    }

    // Function to set form data
    public function setTourFormData($data, $tour, $logedInUserId) {
        if ($data['tourImage']['name'] != '') {
            $tour->setTourImage($data ['tourImage'] ['name']);
        }
        $tour->setTourTitle($data ['tourName']);
        $tour->setTourPrice($data ['price']);
        $tour->setTourCityIdFk($data ['city']);
        $tour->setTourCountryIdFk($data ['country-id']);
        $tour->setTourCreatedBy($logedInUserId);
        $tour->setTourDuration($data ['duration']);
        $tour->setTourDescription($data ['description']);
        $tour->setTourStatus(tour::STATUS_ACTIVE);
        $tour->setTourIsFixed($data ['isFixed']);
        return $tour;
    }

    // Function to return sorted and serach result
    public function getAjaxResult($tourSortValue, $tourName, $userRole, $userId) {
        $tourTable = $this->serviceLocator->get('TourTable');
        if ($userRole == 'Admin') {
            if ($tourSortValue == - 1) {
                $tour = $tourTable->getMany(array('tpod_tour_status' => 1))->toArray();
            } else if ($tourSortValue != null) {
                $tour = $tourTable->getMany(array(
                            'tpod_tour_city_id_fk' => $tourSortValue,
                            'tpod_tour_status' => 1
                        ))->toArray();
            } else {
                $tour = $tourTable->getMany(array(
                            'tpod_tour_name' => $tourName,
                            'tpod_tour_status' => 1
                        ))->toArray();
            }
        } elseif ($userRole == 'Travel Agent') {
            if ($tourSortValue == - 1) {
                $tour = $tourTable->getMany(array('tpod_tour_status' => 1, 'tpod_tour_created_by' => $userId))->toArray();
            } else if ($tourSortValue != null) {
                $tour = $tourTable->getMany(array(
                            'tpod_tour_city_id_fk' => $tourSortValue,
                            'tpod_tour_created_by' => $userId,
                            'tpod_tour_status' => 1
                        ))->toArray();
            } else {
                $tour = $tourTable->getMany(array(
                            'tpod_tour_name' => $tourName,
                            'tpod_tour_created_by' => $userId,
                            'tpod_tour_status' => 1
                        ))->toArray();
            }
        }

        return $tour;
    }

// Function to return sorted and serach result
    public function getAjaxPaginationResult($tourSortValue, $tourName, $pageNo, $userRole, $userId) {
        $tourTable = $this->serviceLocator->get('TourTable');
        if ($userRole == 'Admin') {
            if ($tourSortValue == - 1) {
                $tour = $tourTable->getPaginationResult(array('tpod_tour_status' => 1), array(), $pageNo)->toArray();
            } else if ($tourSortValue != null) {
                $tour = $tourTable->getPaginationResult(array(
                            'tpod_tour_city_id_fk' => $tourSortValue,
                            'tpod_tour_status' => 1
                                ), array(), $pageNo)->toArray();
            } else {
                $tour = $tourTable->getPaginationResult(array(
                            'tpod_tour_name' => $tourName,
                            'tpod_tour_status' => 1
                                ), array(), $pageNo)->toArray();
            }
        } elseif ($userRole == 'Travel Agent') {
            if ($tourSortValue == - 1) {
                $tour = $tourTable->getPaginationResult(array('tpod_tour_status' => 1, 'tpod_tour_created_by' => $userId,), array(), $pageNo)->toArray();
            } else if ($tourSortValue != null) {
                $tour = $tourTable->getPaginationResult(array(
                            'tpod_tour_city_id_fk' => $tourSortValue,
                            'tpod_tour_created_by' => $userId,
                            'tpod_tour_status' => 1
                                ), array(), $pageNo)->toArray();
            } else {
                $tour = $tourTable->getPaginationResult(array(
                            'tpod_tour_name' => $tourName,
                            'tpod_tour_created_by' => $userId,
                            'tpod_tour_status' => 1
                                ), array(), $pageNo)->toArray();
            }
        }
        return $tour;
    }

    /*
     * Function to get form data
     * Merge file data with post data
     */

    public function getFormData() {
        $request = $this->serviceLocator->get('request');
        $nonFile = $request->getPost()->toArray(); // Get form content
        $File = $request->getFiles()->toArray(); // Get form file content
        $data = array_merge_recursive($nonFile, $File);
        return $data;
    }

    /*
     * Get tour image to edit
     */

    public function getTourImage($id) {
        $tourTable = $this->serviceLocator->get('TourTable');
        $tour = $tourTable->getOne(array(
            'tpod_tour_id' => $id
        ));
        return $tourImage = $tour->getTourImage();
    }

    /*
     * Save form data for edit and add action
     * Arguments are form data, tour object and image upload path
     */

    public function saveFormData($data, $tour, $imgUpload, $logedInUserId) {
        $tourTable = $this->serviceLocator->get('TourTable');
        $data ['last_modified_time'] = time();
        $data ['duration'] = $data ['hour'] . ':' . $data ['min'];
        if ($data['tourImage']['name'] != '') {
            $imgUpload->setDestination(APPLICATION_PUBLIC_PATH . '/upload/Tour');
            $imgUpload->receive($data ['tourImage'] ['name']);
        }
        $tour = $this->setTourFormData($data, $tour, $logedInUserId);
        $tourTable->save($tour);
    }

    /*
     * Function to get city list to render in edit form
     */

    public function getCity($id) {
        $tour = $this->getTourObject($id);
        $cityId = $tour->getTourCityIdFk();
        $cityTable = $this->serviceLocator->get('CityTable');
        if ($cityId != 0) {
            $city = $cityTable->getOne(array(
                'tpod_city_id' => $cityId
            ));
            return $city;
        }
    }

    /*
     * Function to get tour object
     */

    public function getTourObject($id) {
        $tourTable = $this->serviceLocator->get('TourTable');
        $tour = $tourTable->getOne(array(
            'tpod_tour_id' => $id
        ));
        return $tour;
    }

}
