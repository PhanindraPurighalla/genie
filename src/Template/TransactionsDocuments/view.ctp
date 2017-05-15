<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transactions Document'), ['action' => 'edit', $transactionsDocument->transaction_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transactions Document'), ['action' => 'delete', $transactionsDocument->transaction_id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionsDocument->transaction_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transactions Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transactions Document'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactionsDocuments view large-9 medium-8 columns content">
    <h3><?= h($transactionsDocument->transaction_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= $transactionsDocument->has('transaction') ? $this->Html->link($transactionsDocument->transaction->title, ['controller' => 'Transactions', 'action' => 'view', $transactionsDocument->transaction->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Document') ?></th>
            <td><?= $transactionsDocument->has('document') ? $this->Html->link($transactionsDocument->document->id, ['controller' => 'Documents', 'action' => 'view', $transactionsDocument->document->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($transactionsDocument->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($transactionsDocument->modified) ?></td>
        </tr>
    </table>
</div>
