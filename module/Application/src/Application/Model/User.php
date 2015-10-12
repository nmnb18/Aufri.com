<?php
/**
* User file contains functions to get and set data from/to user table
* @author Deepika Verma <deepika.verma@optimusinfo.com>
*/
namespace Application\Model;

use Application\Model\AbstractDbModel;
/**
* User file contains functions to get and set data from/to user table
* @author Deepika Verma <deepika.verma@optimusinfo.com>
*/
class User extends AbstractDbModel
{

    protected $id;
    protected $email;
    protected $name;
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }



    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}
