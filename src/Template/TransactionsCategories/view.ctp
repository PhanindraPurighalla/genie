<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transactions Category'), ['action' => 'edit', $transactionsCategory->transaction_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transactions Category'), ['action' => 'delete', $transactionsCategory->transaction_id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionsCategory->transaction_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transactions Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transactions Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactionsCategories view large-9 medium-8 columns content">
    <h3><?= h($transactionsCategory->transaction_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= $transactionsCategory->has('transaction') ? $this->Html->link($transactionsCategory->transaction->title, ['controller' => 'Transactions', 'action' => 'view', $transactionsCategory->transaction->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $transactionsCategory->has('category') ? $this->Html->link($transactionsCategory->category->title, ['controller' => 'Categories', 'action' => 'view', $transactionsCategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($transactionsCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($transactionsCategory->modified) ?></td>
        </tr>
    </table>
</div>
