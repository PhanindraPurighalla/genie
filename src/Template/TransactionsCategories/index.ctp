<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transactions Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactionsCategories index large-9 medium-8 columns content">
    <h3><?= __('Transactions Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactionsCategories as $transactionsCategory): ?>
            <tr>
                <td><?= $transactionsCategory->has('transaction') ? $this->Html->link($transactionsCategory->transaction->title, ['controller' => 'Transactions', 'action' => 'view', $transactionsCategory->transaction->id]) : '' ?></td>
                <td><?= $transactionsCategory->has('category') ? $this->Html->link($transactionsCategory->category->title, ['controller' => 'Categories', 'action' => 'view', $transactionsCategory->category->id]) : '' ?></td>
                <td><?= h($transactionsCategory->created) ?></td>
                <td><?= h($transactionsCategory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transactionsCategory->transaction_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transactionsCategory->transaction_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transactionsCategory->transaction_id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionsCategory->transaction_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
