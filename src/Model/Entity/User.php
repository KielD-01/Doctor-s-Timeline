<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $role
 * @property string $full_name
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\UsersAttending[] $users_attendings
 */
class User extends Entity
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
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Sets a hashed password while creating new user
     *
     * @param null $password
     * @return bool|string
     */
    protected function _setPassword($password = null)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }

    /**
     * Checks role if exists in keys of User array before creating
     * If no role has been set - Patient role will be set automatically
     *
     * @param null $role
     * @return null|string
     */
    protected function _setRole($role = null)
    {
        if (!$role) {
            return 'patient';
        }

        return $role;
    }

    /**
     * Virtual Field : full_name
     * Working only when User Entity returns
     *
     * @return string
     */
    protected function _getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
