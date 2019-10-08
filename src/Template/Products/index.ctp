
<div class="card">
    <div class="card-header"><h3><?= __('List products') ?></h3></div>
    <div class="card-body">
        <?= $this->Flash->render() ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col" class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($products) > 0) : ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th scope="row" class="text-center"><?= $this->Number->format($product->id) ?></th>
                    <td><?= h($product->title) ?></td>
                    <td><?= number_format(h($product->price)) ?><sup>đ</sup></td>
                    <td class="text-center">
                        <?= $this->Html->link(__('Edit'), [
                            'action' => 'edit',
                            $product->id
                        ], [
                            'class' => 'btn btn-sm btn-warning'
                        ]) ?>
                        <?= $this->Form->postLink(__('Delete'), [
                            'action' => 'delete',
                            $product->id
                        ], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">Data empty</td>
                </tr>
            <?php endif; ?>
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
