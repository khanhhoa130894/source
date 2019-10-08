<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ProductCouponTable;
use App\Model\Table\ProductsTable;
use App\Model\Table\OrderDetailTable;
use App\Model\Table\UserCouponTable;
use App\Model\Table\UsersTable;
use Cake\Utility\Hash;
use App\Controller\Component\CommonComponent;
use Cake\Datasource\ConnectionManager;
use mysql_xdevapi\Exception;

/**
 * Class OrdersController
 *
 * @package App\Controller
 * @property \App\Model\Table\OrdersTable $Orders
 * @property \App\Model\Table\ProductsTable $Products
 * @property \App\Model\Table\OrderDetailTable $OrderDetail
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Controller\Component\CommonComponent $Common
 * @property \App\Model\Table\UserCouponTable $UserCoupon
 * @property \App\Model\Table\ProductCouponTable $ProductCoupon
 * @method paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Products');
        $this->loadModel('OrderDetail');
        $this->loadModel('Users');
        $this->loadModel('UserCoupon');
        $this->loadModel('ProductCoupon');
        $this->loadComponent('Common');
    }

    /**
     * Index method
     */
    public function index()
    {
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    /**
     * @param null $id
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
           'contain' => []
        ]);
        $user = $this->Users->get($order->id_user, [
            'contain' => []
        ]);
        $orders_detail = $this->OrderDetail->getOrderDetail($id);
        foreach ($orders_detail as $key => $value) {
            foreach ($value as $quantity => $coupon) {
                $products[$key]['quantity'] = $quantity;
                $products[$key]['coupon'] = $coupon;
            }
            $products[$key]['product'] = $this->Products->get($key, [
                'contain' => []
            ]);
        }

        $this->set(compact('order', 'user', 'products'));
    }

    public function ajaxChangeStatusOrder()
    {
        if($this->request->is('ajax')){
            $data = $this->request->getData();
            $order = $this->Orders->get($data['id'], [
                'contain' => []
            ]);
            $orders = $this->Orders->patchEntity($order, $data);
            if ($this->Orders->save($orders)) {
                echo "Success";
                exit;
            } else {
                echo 'Fail';
                exit;
            }
        }
    }

    /**
     * Add method
     */
    public function add()
    {
        $products = $this->Products->find('all')->toArray();
        $products = Hash::combine($products, '{n}.id', '{n}.title');

        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $order = $this->Orders->patchEntity($order, $data);
            $order->sku_order = $this->Common->randomString(10);
            $order->id_user = $this->Auth->user('id');
            $order->status = 0;

            $connection = ConnectionManager::get('default');
            $connection->begin();
            try {
                $insert_order = $this->Orders->save($order);
                foreach ($data['id_product'] as $key => $value) {
                    $data_order_detail = [];
                    $data_order_detail['id_order'] = $insert_order->id;
                    $data_order_detail['id_product'] = $key;
                    $data_order_detail['quantity'] = $value['quantity'];
                    $data_order_detail['coupon'] = $value['coupon'];
                    $order_detail = $this->OrderDetail->newEntity();
                    $order_detail = $this->OrderDetail->patchEntity($order_detail, $data_order_detail);
                    if ($order_detail->coupon == null) {
                        $order_detail->coupon = '';
                    } else {
                        $this->ProductCoupon->updateUsedCoupon($data_order_detail['coupon']);
                    }
                    $this->OrderDetail->save($order_detail);
                }

                $connection->commit();
                $this->Flash->success(__('Save complete.'));
                return $this->redirect(['action' => 'index']);
            } catch (Exception $e) {
                $connection->rollback();
                $this->Flash->error(__('Save fail.'));
            }
        }

        $this->set(compact('order', 'products'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod('post', 'delete');
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('Delete success.'));
        } else {
            $this->Flash->error(__('Delete fail. Please try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Ajax load price product in page add order
     */
    public function ajaxLoadTotalPrice()
    {
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $data = $this->request->getData();
            $arr_idsp = json_decode($data['arr_idsp'], true);
            $coupon = json_decode($data['coupon'], true);
            $id_user = $this->Auth->user('id');
            $listProducts = $this->Products->getListPriceProductByID($arr_idsp);
            // coupon default decrease 10%
            if ($coupon && $coupon != null) {
                foreach ($coupon as $key => $value) {
                    $exists = $this->UserCoupon->exists([
                        'id_user' => $id_user,
                        'id_product' => $key,
                        'coupon' => $value
                    ]);
                    if ($exists) {
                        $result_user_coupon = $this->UserCoupon->find('all')
                            ->where([
                                'id_user' => $id_user,
                                'id_product' => $key,
                                'coupon' => $value
                            ])
                            ->first()
                            ->toArray();
                        $id_coupon = $result_user_coupon['id_coupon'];
                        $product_coupon = $this->ProductCoupon->get($id_coupon, [
                            'contain' => []
                        ]);
                        $used_coupon = $product_coupon['used'];
                        if ($used_coupon) {
                            $res['error'] = 'The coupon has been used';
                        } else {
                            $res['error'] = '';
                            $listProducts[$key] = $listProducts[$key] - ($listProducts[$key] * 10) / 100;
                        }
                    } else {
                        $res['error'] = 'The coupon is incorrect.';
                    }
                }
            }
            $totalPrice = 0;
            foreach ($listProducts as $id => $price) {
                $totalPrice += $price;
            }
            $res['totalPrice'] = $totalPrice;
            echo json_encode($res);exit;
        }
    }
}
