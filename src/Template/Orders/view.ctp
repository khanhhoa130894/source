
<div class="card">
    <div class="card-header"><h3><?= __('Order detail') ?></h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><?= __('Mã Đơn hàng') ?></td>
                    <td><?= h($order->sku_order) ?></td>
                </tr>
                <tr>
                    <td><?= __('Ngày tạo') ?></td>
                    <td><?= date("d/m/Y", strtotime($order->created)) ?></td>
                </tr>
                <tr>
                    <td><?= __('Tên khách hàng') ?></td>
                    <td><?= h($order->customer_name) ?></td>
                </tr>
                <tr>
                    <td><?= __('Số điện thoại') ?></td>
                    <td><?= h($order->customer_phone) ?></td>
                </tr>
                <tr>
                    <td><?= __('Email') ?></td>
                    <td><?= h($order->customer_email) ?></td>
                </tr>
                <tr>
                    <td><?= __('Người tạo') ?></td>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <td><?= __('Tổng giá') ?></td>
                    <td><?= h($order->total_price) ?></td>
                </tr>
                <tr>
                    <td><?= __('Status') ?></td>
                    <?php
                    $status_default = ['0' => 'New', '1' => 'Deliveried'];
                    ?>
                    <td>
                        <?= $this->Form->select('status', $status_default, [
                            'default' => $order->status,
                            'class' => 'form-control',
                            'id' => 'change-status'
                        ]) ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3><?= __('Sản phẩm') ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?= __('ID') ?></th>
                    <th><?= __('Title') ?></th>
                    <th><?= __('Price') ?></th>
                    <th><?= __('Quantity') ?></th>
                    <th><?= __('Coupon') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) :
                ?>
                <tr>
                    <td><?= h($product['product']->id) ?></td>
                    <td><?= h($product['product']->title) ?></td>
                    <td><?= number_format($product['product']->price) ?><sup>đ</sup></td>
                    <td><?= h($product['quantity']) ?></td>
                    <td><?= h($product['coupon']) ?></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->Element('Script/Orders/ajax_change_status') ?>
