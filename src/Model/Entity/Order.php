<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Order
 * @package App\Model\Entity
 */
class Order extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];
}
