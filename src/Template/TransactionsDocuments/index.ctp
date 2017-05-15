<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transactions Document'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactionsDocuments index large-9 medium-8 columns content">
    <h3><?= __('Transactions Documents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('document_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactionsDocuments as $transactionsDocument): ?>
            <tr>
                <td><?= $transactionsDocument->has('transaction') ? $this->Html->link($transactionsDocument->transaction->title, ['controller' => 'Transactions', 'action' => 'view', $transactionsDocument->transaction->id]) : '' ?></td>
                <td><?= $transactionsDocument->has('document') ? $this->Html->link($transactionsDocument->document->id, ['controller' => 'Documents', 'action' => 'view', $transactionsDocument->document->id]) : '' ?></td>
                <td><?= h($transactionsDocument->created) ?></td>
                <td><?= h($transactionsDocument->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transactionsDocument->transaction_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transactionsDocument->transaction_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transactionsDocument->transaction_id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionsDocument->transaction_id)]) ?>
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
