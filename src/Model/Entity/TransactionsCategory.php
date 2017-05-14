<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionsCategory Entity
 *
 * @property int $transaction_id
 * @property int $category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Transaction $transaction
 * @property \App\Model\Entity\Category $category
 */
class TransactionsCategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'transaction_id' => false,
        'category_id' => false
    ];
}
