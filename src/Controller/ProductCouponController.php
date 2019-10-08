<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\CommonComponent;
use App\Model\Table\ProductsTable;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;


/**
 * Class ProductCouponController
 *
 * @property \App\Model\Table\ProductsTable $ProductCoupon
 * @property ProductsTable $Products
 * @property \App\Controller\Component\CommonComponent $Common
 * @method paginate($object = null, array $settings = [])
 * @package App\Controller
 */
class ProductCouponController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Products');
        $this->loadComponent('Common');
    }

    public function index()
    {
        $coupons = $this->paginate($this->ProductCoupon);

        $this->set(compact('coupons'));
    }

    public function createCodeCoupon($length = 10)
    {
        $code = $this->Common->randomString($length);
        $exists = $this->ProductCoupon->exists(['coupon' => $code]);
        if($exists) {
            $this->createCodeCoupon($length);
        } else {
            return $code;
        }
    }

    public function add()
    {
        $products = $this->Products->find('all')->toArray();
        $products = Hash::combine($products, '{n}.id', '{n}.title');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $id_product = $data['id_product'];
            $number_coupon = $data['number_coupon'];

            if ($id_product && $number_coupon > 0) {

                $result = [];
                $result['id_product'] = $id_product;
                $result['status'] = 0;
                $connection = ConnectionManager::get('default');

                $connection->begin();
                try {
                    for ($i = 0; $i < $number_coupon; $i++) {
                        $codeCoupon = $this->createCodeCoupon(10);
                        $result['coupon'] = $codeCoupon;
                        $coupons = $this->ProductCoupon->newEntity();
                        $coupon = $this->ProductCoupon->patchEntity($coupons, $result);
                        $this->ProductCoupon->save($coupon);
                    }
                    $connection->commit();
                    $this->Flash->success(__('Saved success'));
                    return $this->redirect(['action' => 'index']);
                } catch (Exception $e) {
                    $connection->rollback();
                }
            }
            $this->Flash->error(__('Saved fail.'));
        }

        $this->set(compact('products'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->ProductCoupon->get($id);
        if ($this->ProductCoupon->delete($coupon)) {
            $this->Flash->success(__('Delete success.'));
        } else {
            $this->Flash->error(__('Delete fail.'));
        }

        return $this->redirect($this->referer());
    }
}
