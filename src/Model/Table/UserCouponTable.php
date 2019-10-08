<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class UserCouponTable
 * @package App\Model\Table
 */
class UserCouponTable extends Table
{
    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_coupon');
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
            ->integer('id_user')
            ->requirePresence('id_user', 'create')
            ->notEmptyString('id_user');

        $validator
            ->integer('id_product')
            ->requirePresence('id_product', 'create')
            ->notEmptyString('id_product');

        $validator
            ->integer('id_coupon')
            ->requirePresence('id_coupon', 'create')
            ->notEmptyString('id_coupon');

        $validator
            ->scalar('coupon')
            ->maxLength('coupon', 20)
            ->requirePresence('coupon', 'create')
            ->notEmptyString('coupon');

        return $validator;
    }
}
