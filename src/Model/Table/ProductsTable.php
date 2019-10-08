<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Class ProductsTable
 * @package App\Model\Table
 */
class ProductsTable extends Table
{
    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
//        $this->addBehavior('Sluggable');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create')
            ->notEmptyFile('image');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }

    /**
     * @param array $id
     * @return array|\ArrayAccess
     */
    public function getListPriceProductByID($id = [])
    {
        if (!$id) {
            $id = [];
        }
        $result = $this->find('all', [
            'order' => ['id' => 'DESC']
        ])
            ->select(['id','price'])
            ->where(['id IN' => $id])
            ->toArray();
        if (!$result)
            return $result = [];
        return Hash::combine($result,'{n}.id', '{n}.price');
    }

    public function getListProduct($id = [])
    {
        if (!$id) {
            $id = [];
        }
        $result = $this->find('all', [
            'order' => ['id' => 'DESC']
        ])
            ->where(['id IN' => $id])
            ->toArray();
        if (!$result)
            return $result = [];
        return $result;
    }
}
