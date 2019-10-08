<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class ProductCouponTable
 * @package App\Model\Table
 */
class ProductCouponTable extends Table
{
    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('product_coupon');
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
            ->integer('id_product')
            ->requirePresence('id_product', 'create')
            ->notEmptyString('id_product');

        $validator
            ->scalar('coupon')
            ->maxLength('coupon', 20)
            ->requirePresence('coupon', 'create')
            ->notEmptyString('coupon');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }

    public function getCodeByIDProduct($id_product = null)
    {
        $result = $this->find()
            ->select(['id','coupon'])
            ->where(['id_product' => $id_product, 'status' => 0])
            ->epilog('FOR UPDATE')
            ->first();

        if (!$result) $result = [];

        return $result;
    }

    public function updateCouponAfterGet($id = null)
    {
        $this->query()
            ->update()
            ->set(['status' => 1])
            ->where(['id' => $id])
            ->execute();
    }

    public function updateUsedCoupon($coupon = null)
    {
        $this->query()
            ->update()
            ->set(['used' => 1])
            ->where(['coupon' => $coupon])
            ->execute();
    }
}
