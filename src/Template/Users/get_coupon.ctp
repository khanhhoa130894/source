<div class="card">
    <div class="card-header"><h3>Get coupon</h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <fieldset>
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <?= $this->Form->control('products', [
                            'name' => 'id_product',
                            'type' => 'select',
                            'class' => 'form-control',
                            'id' => 'listProduct',
                            'empty' => 'Select product',
                            'label' => [
                                'text' => 'Choose product'
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="col-4">
                    <?= $this->Form->control('code', [
                        'class' => 'form-control',
                        'id' => 'code-coupon',
                        'readonly' => true,
                        'label' => [
                            'text' => 'Code'
                        ]
                    ]) ?>
                </div>
            </div>
        </fieldset>
        <p class="text-danger alert-get-coupon"></p>
        <?= $this->Form->button(__('Get code'), [
            'type' => 'button',
            'id' => 'get-code',
            'class' => 'btn btn-success'
        ]) ?>
        <?= $this->Html->link(__('Exit'), [
            'action' => 'UserCoupon'
        ], [
            'class' => 'btn btn-secondary'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?= $this->Element('Script/Users/get_coupon') ?>

