<div class="card">
    <div class="card-header"><h3>Edit user</h3></div>
    <div class="card-body">
        <?php if ($this->Flash->render() && $this->Flash->render() !== null) : ?>
        <div class="error alert alert-danger">
            <?= $this->Flash->render() ?>
        </div>
        <?php endif; ?>
        <?= $this->Form->create($user) ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->control('username', [
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

