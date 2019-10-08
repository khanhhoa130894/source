<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ProductCouponTable;
use App\Model\Table\ProductsTable;
use App\Model\Table\UserCouponTable;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\UserCouponTable $UserCoupon
 * @property \App\Model\Table\ProductsTable $Products
 * @property \App\Model\Table\ProductCouponTable $ProductCoupon
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('UserCoupon');
        $this->loadModel('Products');
        $this->loadModel('ProductCoupon');
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param $inputPassword
     * @param $user
     * @return mixed
     */
    public function checkPassword($inputPassword,$user){
        return (new DefaultPasswordHasher)->check($inputPassword,$user->password);
    }

    public function changePassword()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data) {
                if ($this->checkPassword($data['passwordCurrent'], $user)) {
                    if ($data['password'] === $data['passwordConfirm']) {
                        $user = $this->Users->patchEntity($user, $data);
                        if ($this->Users->save($user)) {
                            $this->Flash->success(__('The password has been changed.'));
                        } else {
                            $this->Flash->error(__('The password could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Flash->error(__('Password was wrong.'));
                    }
                } else {
                    $this->Flash->error(__('The current password is incorrect.'));
                }
            } else {
                $this->Flash->error(__('Please enter data.'));
            }
        }
    }

    public function UserCoupon()
    {
        $id_user = $this->Auth->user('id');
        $user_Coupons = $this->UserCoupon->find('all')
            ->order(['id' => 'desc'])
            ->where(['id_user' => $id_user]);
        foreach ($user_Coupons as $userCoupon) {
            $product_coupon = $this->ProductCoupon->get($userCoupon->id_coupon);
            $usedCoupon[$userCoupon->id_coupon] = $product_coupon['used'];
        }
//        $product_coupon = $this->ProductCoupon->get();
//        $user_Coupons['used'] = $product_coupon['used'];
        $userCoupons = $this->paginate($user_Coupons);

        $this->set(compact('userCoupons', 'usedCoupon'));
    }

    public function getCoupon()
    {
        $products = $this->Products->find('all')->toArray();
        $products = Hash::combine($products, '{n}.id', '{n}.title');

        $this->set(compact('products'));
    }

    public function ajaxGetCoupon()
    {
        if ($this->request->is('ajax')) {
            $id_product = $this->request->getData('id_product');
            $id_user = $this->Auth->user('id');
            if ($id_product) {
                $conn = ConnectionManager::get('default');
                $conn->begin();
                try {
                    $result_coupon = $this->ProductCoupon->getCodeByIDProduct($id_product);
                    $coupon = $result_coupon['coupon'];
                    $id_coupon = $result_coupon['id'];
                    if ($result_coupon) {
                        $this->ProductCoupon->updateCouponAfterGet($id_coupon);
                        $data = [
                            'id_product' => $id_product,
                            'id_user' => $id_user,
                            'id_coupon' => $id_coupon,
                            'coupon' => $coupon
                        ];
                        // Each user can only get 1 coupon for 1 product
                        $existsCoupon = $this->UserCoupon->exists([
                            'id_user' => $id_user,
                            'id_product' => $id_product
                        ]);
                        if ($existsCoupon) {
                            $res = [
                                'status' => 0,
                                'coupon' => 'You have taken this product coupon.'
                            ];
                            $conn->rollback();
                        } else {
                            $UserCoupons = $this->UserCoupon->newEntity();
                            $UserCoupons = $this->UserCoupon->patchEntity($UserCoupons, $data);
                            $this->UserCoupon->save($UserCoupons);
                            $res = [
                                'status' => 1,
                                'coupon' => $coupon
                            ];
                            $conn->commit();
                        }
                        echo json_encode($res);
                    }
                } catch (Exception $e) {
                    $conn->rollback();
                }
            }
        }
        exit;
    }
}
