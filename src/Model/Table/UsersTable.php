<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Cache\Cache;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\UsersAttendingsTable|\Cake\ORM\Association\HasMany $UsersAttendings
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('UsersAttendings', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->date('dob')
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    /**
     * Before saving User Marshaller
     *
     * @param Event $event
     * @param User $user
     * @param array $options
     */
    public function beforeSave(Event $event, User $user, $options = [])
    {
        /**
         * If we are updating User record
         * Updated_at will get new value
         */
        if (!$user->isNew()) {
            $user->set('updated_at', Time::now());
        }
    }

    /**
     * After Saving User Marshaller
     * Saves User into specific Cache
     *
     * @param Event $event
     * @param User $user
     * @param array $options
     */
    public function afterSave(Event $event, User $user, $options = [])
    {
        Cache::write("user_{$user->id}", $user, 'users');
    }

    /**
     * Removes specific user cache after deleting User from DB
     *
     * @param Event $event
     * @param User $user
     */
    public function afterDelete(Event $event, User $user)
    {
        Cache::delete("user_{$user->id}", 'users');
    }
}
