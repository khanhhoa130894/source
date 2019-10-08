<div class="card">
    <div class="card-header"><h3>Add product</h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create($product) ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->control('title', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('price', [
                    'type' => 'number',
                    'class' => 'form-control',
                    'pattern' => '[0-9]+(\\.[0-9][0-9]?)?'
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('description', [
                    'type' => 'textarea',
                    'class' => 'form-control',
                    'rows' => '4'
                ]) ?>
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

