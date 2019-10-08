<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     */
    public function index()
    {
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null
     */
    public  function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->slug = Text::slug(strtolower($product->title));
            $product->image = 'test.jpg';
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Fail. Please try again.'));
        }
        $this->set(compact('product'));
    }

    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
           'contain' => []
        ]);
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('Product update successful.'));
                return $this->redirect(['action' => 'idnex']);
            }
            $this->Flash->error(__('Fail, please try again.'));
        }
        $this->set(compact('product'));
    }

    public  function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('Fail. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
