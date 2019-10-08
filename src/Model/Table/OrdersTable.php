<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class OrdersTable
 * @package App\Model\Table
 */
class OrdersTable extends Table
{
    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('sku_order')
            ->maxLength('sku_order', 20)
            ->requirePresence('sku_order', 'create')
            ->notEmptyString('sku_order');

        $validator
            ->integer('id_user')
            ->requirePresence('id_user', 'create')
            ->notEmptyString('id_user');

        $validator
            ->scalar('customer_name')
            ->maxLength('customer_name', 255)
            ->requirePresence('customer_name', 'create')
            ->notEmptyString('customer_name');

        $validator
            ->scalar('customer_phone')
            ->maxLength('customer_phone', 10)
            ->requirePresence('customer_phone', 'create')
            ->notEmptyString('customer_phone');

        $validator
            ->scalar('customer_email')
            ->maxLength('customer_email', 255)
            ->requirePresence('customer_email', 'create')
            ->notEmptyString('customer_email');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->numeric('total_price')
            ->requirePresence('total_price', 'create')
            ->notEmptyString('total_price');

        return $validator;
    }
}
