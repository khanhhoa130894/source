<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Class OrderDetailTable
 * @package App\Model\Table
 */
class OrderDetailTable extends Table
{
    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('order_detail');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('id_order')
            ->requirePresence('id_order', 'create')
            ->notEmptyString('id_order');

        $validator
            ->integer('id_product')
            ->requirePresence('id_product', 'create')
            ->notEmptyString('id_product');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('coupon')
            ->maxLength('coupon', 20)
            ->requirePresence('coupon', 'create');

        return $validator;
    }

    public function getOrderDetail($id_order = null)
    {
        $result = $this->find('all')
            ->where(['id_order' => $id_order])
            ->toArray();
        return Hash::combine($result, '{n}.quantity', '{n}.coupon', '{n}.id_product');
    }
}
