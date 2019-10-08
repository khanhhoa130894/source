<div class="card">
    <div class="card-header"><h3>Create coupon</h3></div>
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
                        <div class="form-group">
                            <?= $this->Form->control('number_coupon', [
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>
                    </div>
                </div>
        </fieldset>
        <?= $this->Form->button(__('Submit'), [
            'class' => 'btn btn-success'
        ]) ?>
        <?= $this->Html->link(__('Cancel'), [
            'action' => 'index'
        ], [
            'class' => 'btn btn-secondary'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

