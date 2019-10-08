<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class UserCoupon
 * @package App\Model\Entity
 */
class UserCoupon extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];
}
