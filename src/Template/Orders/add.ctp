<div class="card">
    <div class="card-header"><h3>Add order</h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create($order) ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->control('customer_name', [
                    'class' => 'form-control',
                    'label' => [
                        'text' => 'Tên khách hàng'
                    ]
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('customer_phone', [
                    'class' => 'form-control',
                    'label' => [
                        'text' => 'Số điện thoại'
                    ]
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('customer_email', [
                    'type' => 'email',
                    'class' => 'form-control',
                    'label' => [
                        'text' => 'Email'
                    ]
                ]) ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <?= $this->Form->control('products', [
//                            'name' => 'id_product',
                            'type' => 'select',
                            'class' => 'form-control',
                            'id' => 'listProduct',
                            'empty' => 'Select product',
                            'label' => [
                                'text' => 'Thêm sản phẩm đơn hàng'
                            ]
                        ]) ?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <?= $this->Form->control('total_price', [
                            'type' => 'number',
                            'id' => 'total-price',
                            'class' => 'form-control',
                            'readonly' => true,
                            'label' => [
                                'text' => 'Tổng đơn hàng'
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="content-list-product">
                    <!--Content load product ajax-->
                    <!--<div class="item col-6 col-sm-4 col-md-3 col-lg-2">
                        <span class="tag badge badge-info">test<span class="remove"></span></span>
                    </div>-->
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit'), [
            'class' => 'btn btn-success'
        ]) ?>
        <?= $this->Html->link(__('Cancel'), [
            'controller' => 'Products',
            'action' => 'index'
        ], [
            'class' => 'btn btn-secondary'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?= $this->Element('Script/Orders/select_product') ?>

