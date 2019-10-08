
<div class="card">
    <div class="card-header"><h3><?= __('List orders') ?></h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Mã ĐH') ?></th>
                <th scope="col"><?= __('SĐT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Tổng giá') ?></th>
                <th scope="col"><?= __('status') ?></th>
                <th scope="col" class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <th scope="row" class="text-center"><?= $this->Number->format($order->id) ?></th>
                    <td><?= h($order->sku_order) ?></td>
                    <td><?= h($order->customer_phone) ?></td>
                    <td><?= number_format(h($order->total_price)) ?><sup>đ</sup></td>
                    <td><?= $order->status ? __('Deliveried') : __('New') ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), [
                            'action' => 'view',
                            $order->id
                        ], [
                            'class' => 'btn btn-sm btn-warning'
                        ]) ?>
                        <?= $this->Form->postLink(__('Delete'), [
                            'action' => 'delete',
                            $order->id
                        ], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $order->id),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
