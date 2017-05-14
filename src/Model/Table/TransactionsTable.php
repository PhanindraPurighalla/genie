<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsToMany $Categories
 *
 * @method \App\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('transactions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'transaction_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'transactions_categories'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->numeric('transaction_amount')
            ->requirePresence('transaction_amount', 'create')
            ->notEmpty('transaction_amount');

        $validator
            ->dateTime('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    // The $query argument is a query builder instance.
    // The $options array will contain the 'categories' option we passed
    // to find('categorized') in our controller action.
    public function findCategorized(Query $query, array $options)
    {
        $transactions = $this->find()
            ->select(['id', 'title', 'description', 'transaction_date', 'transaction_amount']);

        $transactions
                ->contain('Users')
                ->where(['Users.id = ' => $options['loggedInUser']]);

        if (empty($options['categories'])) {
            $transactions
                ->leftJoinWith('Categories')
                ->where(['Categories.title IS' => null]);
        } else {
            $transactions
                ->innerJoinWith('Categories')
                ->where(['Categories.title IN ' => $options['categories']]);
        }

        return $transactions->group(['Transactions.id']);
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->category_string) {
            $entity->categories = $this->_buildCategories($entity->category_string);
        }
    }

    protected function _buildCategories($categoryString)
    {
        // Trim categories
        $newCategories = array_map('trim', explode(',', $categoryString));
        // Remove all empty categories
        $newCategories = array_filter($newCategories);
        // Reduce duplicated categories
        $newCategories = array_unique($newCategories);

        $out = [];
        $query = $this->Categories->find()
            ->where(['Categories.title IN' => $newCategories]);

        // Remove existing categories from the list of new categories.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newCategories);
            if ($index !== false) {
                unset($newCategories[$index]);
            }
        }
        // Add existing categories.
        foreach ($query as $category) {
            $out[] = $category;
        }
        // Add new categories.
        foreach ($newCategories as $category) {
            $out[] = $this->Categories->newEntity(['title' => $category]);
        }
        return $out;
    }
}
