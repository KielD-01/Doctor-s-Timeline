<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersAttendings Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AttendingTimesTable|\Cake\ORM\Association\BelongsTo $AttendingTimes
 *
 * @method \App\Model\Entity\UsersAttending get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersAttending newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersAttending[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersAttending|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersAttending patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersAttending[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersAttending findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersAttendingsTable extends Table
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

        $this->setTable('users_attendings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AttendingTimes', [
            'foreignKey' => 'attending_time_id',
            'joinType' => 'INNER'
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
            ->date('attending_date')
            ->requirePresence('attending_date', 'create')
            ->notEmpty('attending_date');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

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
        $rules->add($rules->existsIn(['attending_time_id'], 'AttendingTimes'));

        return $rules;
    }
}
