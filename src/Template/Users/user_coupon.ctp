
<div class="card">
    <div class="card-header"><h3><?= __('List coupon') ?></h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <div class="my-3">
            <?= $this->Html->link(__('Get coupon'), [
                'action' => 'getCoupon'
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
                <!--<th scope="col"><?/*= __('Status') */?></th>-->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userCoupons as $userCoupon): ?>
                <tr>
                    <th scope="row" class="text-center"><?= $this->Number->format($userCoupon->id) ?></th>
                    <td><?= h($userCoupon->id_product) ?></td>
                    <td><?= h($userCoupon->coupon) ?></td>
                    <td><?= $usedCoupon[$userCoupon->id_coupon] ? 'Used' : 'New' ?></td>
                    <!--<td><?/*= $userCoupon->status ? __('Used') : __('New') */?></td>-->
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination justify-content-center">
                <?php
                $this->Paginator->templates([
                    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'current' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]); ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
