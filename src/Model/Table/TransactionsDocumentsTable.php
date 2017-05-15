<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionsDocuments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Transactions
 * @property \Cake\ORM\Association\BelongsTo $Documents
 *
 * @method \App\Model\Entity\TransactionsDocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransactionsDocument newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TransactionsDocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransactionsDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionsDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionsDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionsDocument findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsDocumentsTable extends Table
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

        $this->setTable('transactions_documents');
        $this->setDisplayField('transaction_id');
        $this->setPrimaryKey(['transaction_id', 'document_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Documents', [
            'foreignKey' => 'document_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));
        $rules->add($rules->existsIn(['document_id'], 'Documents'));

        return $rules;
    }
}
