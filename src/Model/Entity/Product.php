<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Product
 * @package App\Model\Entity
 */
class Product extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];
}
