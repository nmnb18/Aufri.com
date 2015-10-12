<?php

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;

class SettingHelper {

    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $setting = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($setting)) {
            $this->setSetting($setting);
        }
    }

    public function setSetting(Setting $setting) {
        $this->setting = $setting;
        return $this;
    }

    // Function to set form data
    public function setSettingFormData($data, $setting, $settingId) {
        $setting->setAdminSettingId($settingId);
        $setting->setAdminFbKey($data ['key']);
        $setting->setAdminMailchimpKey($data ['url']);
        $setting->setAdminMailchimpId($data ['id']);
        return $setting;
    }

}
