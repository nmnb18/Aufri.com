<?php

/**
 * Helper containing functions to manage User pages 
 * @author Chandrika Sharma <chandrika.sharma@optimusinfo.com>
 */

namespace Application\Model\Helpers;

use Zend\Form\View\Helper\AbstractHelper;
use Application\Controller\AbstractController;
use Application\Model\UserRole;
use Application\Model\UserRoleTable;
use Application\Model\Role;
use Application\Model\RoleTable;
use Application\Model\AttractionTable;
use Zend\Crypt\Password\Bcrypt;
use Application\Model\User;

/**
 * Description of UserHelper
 * @author Chandrika Sharma  <chandrika.sharma@optimusinfo.com>
 */
class UserHelper {

    protected $error = array();

    /**
     * Function to define Service Locator
     * @return true
     */
    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $attraction = null) {
        $this->serviceLocator = $serviceLocator;
        if (!empty($attraction)) {
            $this->setAttraction($attraction);
        }
    }

    /**
     * Function to get list of roles to show in view for roles select box.
     * @return $roles array containing roles
     */
    public function getRolesList() {
        $roleTable = $this->serviceLocator->get('RoleTable');
        $roleArray = $roleTable->getMany()->toArray();
        $roles = array();
        foreach ($roleArray as $roleVal) {
            $roles [$roleVal ['tpodRoleId']] = $roleVal ['tpodRoleRoleName'];
        }
        return $roles;
    }

    /**
     * Function to get list of roles to show in view for roles select box.
     * @return array $user array containing user data after editing/ adding
     * @param array   $data          array containing user data entered in the form 
     * @param array   $user          array in which user data will be filled
     * @param integer $logedInUserId integer set if the user id loggedin
     */
    public function setUserFormData($data, $user, $logedInUserId = null) {
        $bcrypt = new Bcrypt();
        $token = md5(uniqid(mt_rand(), true));
        if ($logedInUserId != null) {
            $user->setId($logedInUserId);
        }
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setPhoneNumber($data['phonenumber']);
        if ($logedInUserId == null) {
            $user->setPassword($bcrypt->create($data['password']));
        }
        $user->setActivationCode($token);
        $user->setStatus(User::STATUS_ACTIVE);

        return $user;
    }

    /**
     * Function to get user roles
     * @return array $roleName array role name
     * @param integer $userId integer containing user id
     */
    public function getUserRole($userId) {
        $userRoleTable = $this->serviceLocator->get('UserRoleTable');
        $userRole = $userRoleTable->getOne(
                array('tpod_usr_role_user_id_fk' => $userId)
        );
        $roleId = $userRole->getRoleId();
        $roleTable = $this->serviceLocator->get('RoleTable');
        $role = $roleTable->getOne(array('tpod_role_id' => $roleId));
        $roleName = $role->getRoleName();
        return $roleName;
    }

    /**
     * Function to set user roles
     * @return array $userRole array user role
     * @param array $data array containing data entered in the form
     * @param array $user array in which user data is saved
     */
    public function setUserRole($data, $user) {
        $userRole = new UserRole();
        $userRole->setRoleId($data['roles']);
        $userRole->setUserId($user->getId());
        return $userRole;
    }

    /**
     * Function to get roles from roleId
     * @return string $role contains the role name
     * @param integer $roleId contains role id
     */
    public function getUserRoleName($roleId) {
        $RoleTable = $this->serviceLocator->get('RoleTable');
        $role = $RoleTable->getOne(array('tpod_role_id' => $roleId));
        $role = $role->getRoleName();
        return $role;
    }

    /**
     * Function to set profile form data
     * @param array $data contains data entered in the form
     * @return object $user 
     */
    public function setProfileFormData($data, $user) {
        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setName($data['username']);
        $user->setPhoneNumber($data['phone']);
        return $user;
    }

    /**
     * Function to set new password
     * @param array $data contains data entered in the form
     * @return object $user 
     */
    public function setNewPassword($data, $user) {
        $user->setPassword($data['password']);
        $user->setId($data['id']);
        return $user;
    }

    /**
     * Function to get user data
     * @param Object $userTable
     * @param int    $logedInUserId
     * @return object $userData 
     */
    public function getUserData($userTable, $logedInUserId) {
        $userData = $userTable->getOne(
                array(
                    'tpod_usr_id' => $logedInUserId
                )
        );
        return $userData;
    }

    /**
     * Function to get post data
     * @return Array $data 
     */
    public function getPostData() {
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray();
        return $data;
    }

    /**
     * Function to validate signup form
     * @param array $data array containing data entered in the form
     * @return String
     * */
    public function validateForm($data) {
        $message='';
        $userTable = $this->serviceLocator->get('UserTable');
        $user = $userTable->userExists($data['email']);
        if (!empty($user)) {// email already exist
            $message = 'Email Already Exist';
        } else {
            if ($data['password'] != $data['confirmPassword']) {//Passwords do not match
                $message = 'Password do not match';
            }
        }
        return $message;
    }
    public function setSignupContent($data,$user,$token){
        $bcrypt = new Bcrypt();
        $user->setEmail($data['email']);
        $user->setPassword($bcrypt->create($data['password']));
        $user->setActivationCode($token);
        $user->setStatus(User::STATUS_WAITING);
        return $user;
    }

}
