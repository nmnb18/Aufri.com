<?php

namespace Admin\Controller;

use Application\Controller\AbstractAppController;
use Application\Model\Coupon;
use Admin\Form\CouponForm;

class CouponController extends AbstractAppController {

    /**
     * Main action to dispaly all products
     * @return Boolean
     * */
    public function indexAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $couponTable = $this->getServiceLocator()->get('CouponTable');
        $coupons = $couponTable->getMany()->toArray();
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            if(!empty($data['couponCode'])) {
                $coupons = $couponTable->getMany(array('aufri_coupons_code' => $data['couponCode']))->toArray();
            }
        }
        $view = array(
            'coupons' => $coupons,
        );
        return $this->renderView($view);
    }

    /**
     * Main action to add tours
     * @return Boolean
     * */
    public function addAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }
        // Set Variables
        $request = $this->serviceLocator->get('request');
        $coupon = new Coupon();
        $id = '';
        $couponTable = $this->getServiceLocator()->get('CouponTable');

        $couponForm = new CouponForm($coupon); // Render attraction form
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            $this->validateForm($id, $couponForm, $data, $coupon, $couponTable);
        }
        return $this->renderView(
            array('form' => $couponForm)
        );
    }

    /**
     * Main action to edit tours
     * @return Boolean
     * */
    public function editAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }

        $request = $this->serviceLocator->get('request');
        $id = $this->params('id', false);
        $couponTable = $this->serviceLocator->get('CouponTable');
        $coupon = $couponTable->getOne(array('aufri_coupons_id' => $id));

        $couponForm = new CouponForm($coupon); // Render attraction form
        $data = $request->getPost()->toArray(); // Get form content
        if ($request->isPost()) {
            $coupon->setCouponId($id);
            $this->validateForm($id, $couponForm, $data, $coupon, $couponTable);
        }
        return $this->renderView(
            array(
                'form' => $couponForm,
            )
        );
    }

    /**
     * Function created to validate form
     * @return TRUE
     * @param int    $id         contains tour id
     * @param string $tourForm   contains form name
     * @param array  $data       contains form values
     * @param array  $tourHelper contains tourhelper object
     * @param Object $tour       contains tour object
     * @param array  $tourImage  contains tour image detail
     * */
    function validateForm($id, $couponForm, $data,  $coupon, $couponTable) {
        $couponForm->setData($data);
        if (!$couponForm->isValid()) {
            return false;
        } else {
            try {
                $this->beginDbTransaction();
                $coupon->setCouponName($data['name']);
                $coupon->setCouponCode($data['code']);
                $coupon->setCouponStartdate($data['startdate']);
                $coupon->setCouponEnddate($data['enddate']);
                $coupon->setCouponDiscount($data['discount']);
                $coupon->setCouponAvailfor($data['availfor']);
                $coupon->setCouponMinorder($data['minorder']);
                $coupon->setCouponType($data['type']);
                $coupon->setCouponCountForAnyCustomer($data['anycount']);
                $coupon->setCouponForSingleCustomer($data['singlecount']);
                $coupon = $couponTable->save($coupon);
                $this->setSuccessMessage("Coupon added successsfully");
                $this->commitDbTransaction();
                return $this->redirect()->toRoute('admin_view_coupons');
            } catch (Exception $ex) {
                $this->rollbackDbTransaction();
            }
        }
    }

    /**
     * Function created to show tour details
     * @return Boolean
     * */
    public function detailsAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $id = $this->params('id', false);
        $couponTable = $this->getServiceLocator()->get('CouponTable');
        $coupon = $couponTable->getOne(array('aufri_coupons_id'=>$id));
        $view = array(
            'coupon' => $coupon
        );
        return $this->renderView($view);
    }

}
