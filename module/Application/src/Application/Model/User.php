<?php
namespace Application\Model;

use Application\Model\AbstractDbModel;

class User extends AbstractDbModel
{

    protected $aufriUsersId;
    protected $aufriUsersEmail;
    protected $aufriUsersPhoneNo;
    protected $aufriUsersName;
    protected $aufriUsersGender;
    protected $aufriUsersAddressIdFk;
    protected $aufriUsersPassword;
    protected $aufriUsersAcctStatus;
    protected $aufriUsersAcctCreatedOn;
    protected $aufriUsersLastModifiedOn;
    protected $aufriUsersActivationCode;

    public function getUserId()
    {
        return $this->aufriUsersId;
    }
    public function getUserEmail()
    {
        return $this->aufriUsersEmail;
    }
    public function getUserPhoneNo()
    {
        return $this->aufriUsersPhoneNo;
    }
    public function getUserName()
    {
        return $this->aufriUsersName;
    }
    public function getUserGender()
    {
        return $this->aufriUsersGender;
    }
    public function getUserAddressIdFk()
    {
        return $this->aufriUsersAddressIdFk;
    }
    public function getUserPassword()
    {
        return $this->aufriUsersPassword;
    }
    public function getUserAcctStatus()
    {
        return $this->aufriUsersAcctStatus;
    }
    public function getUserActivationCode()
    {
        return $this->aufriUsersActivationCode;
    }

    public function setUserId($aufriUsersId)
    {
        return $this->aufriUsersId = $aufriUsersId;
    }
    public function setUserEmail($aufriUsersEmail)
    {
        return $this->aufriUsersEmail = $aufriUsersEmail;
    }
    public function setUserPhoneNo($aufriUsersPhoneNo)
    {
        return $this->aufriUsersPhoneNo = $aufriUsersPhoneNo;
    }
    public function setUserName($aufriUsersName)
    {
        return $this->aufriUsersName = $aufriUsersName;
    }
    public function setUserGender($aufriUsersGender)
    {
        return $this->aufriUsersGender = $aufriUsersGender;
    }
    public function setUserAddressIdFk($aufriUsersAddressIdFk)
    {
        return $this->aufriUsersAddressIdFk = $aufriUsersAddressIdFk;
    }
    public function setUserPassword($aufriUsersPassword)
    {
        return $this->aufriUsersPassword = $aufriUsersPassword;
    }
    public function setUserAcctStatus($aufriUsersAcctStatus)
    {
        return $this->aufriUsersAcctStatus = $aufriUsersAcctStatus;
    }
    public function setUserActivationCode($aufriUsersActivationCode)
    {
        return $this->aufriUsersActivationCode = $aufriUsersActivationCode;
    }

}
