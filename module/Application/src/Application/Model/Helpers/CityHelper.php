<?php

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Model\CountryTable;
use Application\Model\CityTable;
use Application\Model\CityImageTable;

class CityHelper {

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $city = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($city)) {
            $this->setCity($city);
        }
    }

    public function setCity(City $city) {
        $this->city = $city;
        return $this;
    }

    // function to calculate latitude and longitude
    public function getCoordinates($data) {
        if (!empty($data)) {
            $data = str_replace(" ", "-", $data);
            $geocode_stats = file_get_contents(MAPS_API_PATH . $data);
            $output_deals = json_decode($geocode_stats);
            if (!empty($output_deals->results[0]->geometry->location)) {
                $latLng = $output_deals->results[0]->geometry->location;
                return $latLng;
            }
            return false;
        }
    }

    // Function to set form data
    public function setCityFormData($data, $city, $logedInUserId) {
        $cityTable = $this->serviceLocator->get('CityTable');
        $city->setCityLatitude($data['latitude']);
        $city->setCityLongitude($data['longitude']);
        $city->setCityName($data['city']);
        $city->setCityCountryIdFk($data['countryId']);
        $city->setCityMustsee($data['mustsee']);
        $city->setCityRecommendation($data['recommendation']);
        $city->setUserIdFk($logedInUserId);
        $city->setCityLastModifiedTime($data['last_modified_time']);
        $city->setCityOverview($data['overview']);
        $city = $cityTable->save($city);  // save  city array
        return $city;
    }

    //function to set city image 

    public function saveCityImage($cityImages, $cityId, $cityImage, $imgUpload) {
        $cityImageTable = $this->serviceLocator->get('CityImageTable');

        for ($imgCount = 0; $imgCount < count($cityImages); $imgCount++) { // loop to save multiple city images in database
            if (!empty($cityImages[$imgCount]['name'])) {
                $imgUpload->receive($cityImages[$imgCount]['name']);
                $cityImage->setCityImageName($cityImages[$imgCount]['name']);
                $cityImage->setCityFk($cityId);
                $cityImageTable->save($cityImage);
            }
        }
    }

    //get city images
    public function getCityImages($id) {
        $cityImageTable = $this->serviceLocator->get('CityImageTable');
        return $cityImageTable->getMany(array('tpod_city_fk' => $id, 'tpod_city_img_status' => 0))->toArray();
    }

    //function to get countryname by country id
    public function getCountryName($id) {
        $countryTable = $this->serviceLocator->get('CountryTable');
        return $countryTable->getOne(array('tpod_country_id' => $id));
    }

    // Function to return sorted value for search result
    public function getAjaxResult($sortValue) {
        $cityTable = $this->serviceLocator->get('CityTable');
        if ($sortValue == - 1) {
            $city = $cityTable->getMany(array('tpod_city_status' => 1))->toArray();
        } else {
            $city = $cityTable->getMany(array(
                        'tpod_city_country_id_fk' => $sortValue,
                        'tpod_city_status' => 1
                    ))->toArray();
        }
        return $city;
    }

    public function getCityImagesCount($id) {
        $imgTable = $this->serviceLocator->get('CityImageTable');
        return count($imgTable->getMany(array('tpod_city_fk' => $id, 'tpod_city_img_status' => 0))->toArray());
    }

}
