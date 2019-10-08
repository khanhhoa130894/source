<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class OrderDetail
 * @package App\Model\Entity
 */
class OrderDetail extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];
}
