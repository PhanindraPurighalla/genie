<h1>
    Transactions categorized by
    <?= $this->Text->toList(h($categories)) ?>
</h1>

<section>
<?php foreach ($transactions as $transaction): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(__($transaction->title), ['action' => 'view', $transaction->id]) ?></h4>
        <small><?= h($transaction->transaction_amount) ?></small>

        <!-- Use the TextHelper to format text -->
        <?= $this->Text->autoParagraph(h($transaction->description)) ?>
    </article>
<?php endforeach; ?>
</section>