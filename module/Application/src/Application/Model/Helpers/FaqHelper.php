<?php

/**
 * Description of faqHelper
 * Helper containing functions to set and get attraction methos
 * @author Naman <naman.bakliwal@optimusinfo.com>
 */

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Model\CountryTable;
use Application\Model\CityTable;
use Application\Model\FaqTable;

class FaqHelper {

    protected $error = array();

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $faq = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($faq)) {
            $this->setFaq($faq);
        }
    }

    public function setFaq(Faq $faq) {
        $this->faq = $faq;
        return $this;
    }

   

    // Function to set form data
    public function setFaqFormData($id,$data, $faq, $logedInUserId) {
    	if(!$id) {
    		$faq->setFaqCityIdFk($data['city']);
    		$faq->setFaqCountryIdFk($data['country-id']);
    	}
        $faq->setUserIdFk($logedInUserId);
        $faq->setFaqDetails($data ['details']);
        return $faq;
    }

    /*
     * Function to get form data
     * Merge file data with post data
     */

    public function getFormData() {
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray(); // Get form content
        return $data;
    }

    /*
     * Save form data for edit and add action
     * Arguments are form data, faq object
     */

    public function saveFormData($id,$data, $faq, $logedInUserId) {
        $faqTable = $this->serviceLocator->get('FaqTable');
        $faq = $this->setFaqFormData($id,$data, $faq, $logedInUserId);
        return $faqTable->save($faq);
    }

    /*
     * Function to get city name
     */

    public function getCity($id) {
        $cityTable = $this->serviceLocator->get('CityTable');
        $city = $cityTable->getOne(array(
            'tpod_city_id' => $id
        ));
        return $city;
    }

    /*
     * Function to get country name
     */

    public function getCountry($id) {
        $countryTable = $this->serviceLocator->get('CountryTable');
        $country = $countryTable->getOne(array(
            'tpod_country_id' => $id
        ));
        return $country;
    }

    /*
     * Function to get city list to render in edit form
     */

    public function getFaqCity($id) {
        $faqTable = $this->serviceLocator->get('FaqTable');
        $faq = $faqTable->getOne(array(
            'tpod_Faq_id' => $id
        ));
        $cityId = $faq->getFaqCityIdFk();
        $cityTable = $this->serviceLocator->get('CityTable');
       
        if ($cityId != 0) {
            $city = $cityTable->getOne(array(
                'tpod_city_id' => $cityId
            ));
            return $city;
        }
    }
    /*
     * Function to get faq  object
     */

    public function getFaqObject($id) {
        $faqTable = $this->serviceLocator->get('FaqTable');
        $faq = $faqTable->getOne(array(
            'tpod_faq_id' => $id
        ));
        return $faq;
    }

}
