<?php
namespace Application\Model;

use Application\Model\AbstractDbModel;

class UserRole extends AbstractDbModel
{
    protected $aufriUsersRoleId;
    protected $aufriUsersRoleUserIdFk;
    protected $aufriUsersRoleRoleIdFk;

    public function getUserRoleId() {
        return $this->aufriUsersRoleId;
    }
    public function getUserRoleUserIdFk() {
        return $this->aufriUsersRoleUserIdFk;
    }
    public function getUserRoleIdFk() {
        return $this->aufriUsersRoleRoleIdFk;
    }

    public function setUserRoleId($aufriUsersRoleId) {
        return $this->aufriUsersRoleId = $aufriUsersRoleId;
    }
    public function setUserRoleUserIdFk($aufriUsersRoleUserIdFk) {
        return $this->aufriUsersRoleUserIdFk = $aufriUsersRoleUserIdFk;
    }
    public function setUserRoleIdFk($aufriUsersRoleRoleIdFk) {
        return $this->aufriUsersRoleRoleIdFk = $aufriUsersRoleRoleIdFk;
    }
}
