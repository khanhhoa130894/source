<?php
namespace  App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Class User
 * @package App\Model\Entity
 */
class User extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];

    /**
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * @param $password
     * @return false|string
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

}
