<div class="card">
    <div class="card-header"><h3>Add user</h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create($user) ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->control('username', [
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
                <?= $this->Form->control('email', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->radio('group_account', [
                    [
                        'value' => 0,
                        'text' => 'Customer',
                        'label' => [
                            'class' => 'mr-2'
                        ]
                    ],
                    [
                        'value' => 1,
                        'text' => 'User admin'
                    ]
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

