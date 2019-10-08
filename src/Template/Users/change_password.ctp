<div class="card">
    <div class="card-header"><h3>Change password</h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->control('passwordCurrent', [
                    'type' => 'password',
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('password', [
                    'type' => 'password',
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('passwordConfirm', [
                    'type' => 'password',
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit'), [
            'class' => 'btn btn-success'
        ]) ?>
        <?= $this->Html->link(__('Cancel'), [
            'controller' => 'Users',
            'action' => 'index'
        ], [
            'class' => 'btn btn-secondary'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

