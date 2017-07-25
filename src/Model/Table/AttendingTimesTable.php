<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttendingTimes Model
 *
 * @property \App\Model\Table\UsersAttendingsTable|\Cake\ORM\Association\HasMany $UsersAttendings
 *
 * @method \App\Model\Entity\AttendingTime get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttendingTime newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttendingTime[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttendingTime|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendingTime patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttendingTime[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttendingTime findOrCreate($search, callable $callback = null, $options = [])
 */
class AttendingTimesTable extends Table
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

        $this->setTable('attending_times');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('UsersAttendings', [
            'foreignKey' => 'attending_time_id'
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
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

        return $validator;
    }
}
