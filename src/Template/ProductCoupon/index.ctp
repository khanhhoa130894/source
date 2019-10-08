
<div class="card">
    <div class="card-header"><h3><?= __('List coupon') ?></h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <div class="my-3">
            <?= $this->Html->link(__('Create coupon'), [
                'action' => 'add'
            ], [
                'class' => 'btn btn-success'
            ]) ?>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID Product') ?></th>
                <th scope="col"><?= __('Coupon') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <th scope="row" class="text-center"><?= $this->Number->format($coupon->id) ?></th>
                    <td><?= h($coupon->id_product) ?></td>
                    <td><?= h($coupon->coupon) ?></td>
                    <td><?= $coupon->status ? __('Used') : __('New') ?></td>
                    <td class="text-center">
                        <?= $this->Form->postLink(__('Delete'), [
                            'action' => 'delete',
                            $coupon->id
                        ], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $coupon->id),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination justify-content-center">
                <?php
                $this->Paginator->templates([
                    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'current' => '<li class="page-item disabled"><a class="page-link bg-danger text-light" href="{{url}}">{{text}}</a></li>',
                    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]); ?>
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
