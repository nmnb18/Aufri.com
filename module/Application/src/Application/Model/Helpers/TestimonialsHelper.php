<?php

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Model\TestimonialsTable;
use Application\Model\Testimonials;

/**
 * Description of ItineraryHelper
 *
 * @author TM
 */
class TestimonialsHelper {

    protected $error = array();

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $testimonials = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($testimonials)) {
            $this->setTestimonials($testimonials);
        }
    }

    public function setTestimonials(Testimonials $testimonials) {
        $this->testimonials = $testimonials;
        return $this;
    }

    // Function to set form data
    public function setTestimonialsFormData($data, $testimonials) {
        if($data['testimonialsImage']['name'] != ''){
        $testimonials->setTestimonialsImage($data ['testimonialsImage'] ['name']);
        }
        $testimonials->setTestimonialsTitle($data['title']);
        $testimonials->setTestimonialsUsername($data['username']);
        $testimonials->setTestimonialsContent($data['content']);
      

        return $testimonials;
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
     * Get to image to edit
     */

    public function getTestimonialsImage($id) {
        $testimonialsTable = $this->serviceLocator->get('TestimonialsTable');
        $testimonials = $testimonialsTable->getOne(array(
            'tpod_testimonials_id' => $id
        ));
        return $testimonialsImage = $testimonials->getTestimonialsImage();
    }

    /*
     * Save form data for edit and add action
     * Arguments are form data, testimonials object and image upload path
     */

    public function saveFormData($data, $testimonials, $imgUpload) {
        $testimonialsTable = $this->serviceLocator->get('TestimonialsTable');
        if($data['testimonialsImage']['name'] != ''){
        $imgUpload->setDestination(APPLICATION_PUBLIC_PATH . '/upload/Testimonials');
        $imgUpload->receive($data ['testimonialsImage'] ['name']);
        }
        $testimonials = $this->settestimonialsFormData($data, $testimonials);
        $testimonialsTable->save($testimonials);
    }

    /*
     * Function to get testimonials object
     */

    public function getObject($id) {
        $testimonialsTable = $this->serviceLocator->get('TestimonialsTable');
        $testimonials = $testimonialsTable->getOne(array(
            'tpod_testimonials_id' => $id
        ));
        return $testimonials;
    }

}
