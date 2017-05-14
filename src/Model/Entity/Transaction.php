<?php
namespace App\Model\Entity;

use Cake\Collection\Collection;
use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property float $transaction_amount
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category[] $categories
 */
class Transaction extends Entity
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
        'user_id' => true,
        'title' => true,
        'description' => true,
        'transaction_date' => true,
        'transaction_amount' => true,
        'user' => true,
        'categories' => true,
        'category_string' => true,
    ];

    protected function _getCategoryString()
    {
        if (isset($this->_properties['category_string'])) {
            return $this->_properties['category_string'];
        }
        if (empty($this->categories)) {
            return '';
        }
        $categories = new Collection($this->categories);
        $str = $categories->reduce(function ($string, $category) {
            return $string . $category->title . ', ';
        }, '');
        return trim($str, ', ');
    }
}
