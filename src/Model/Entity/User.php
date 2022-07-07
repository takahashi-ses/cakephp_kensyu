<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $account
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $zipcode
 * @property string $address
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $created_user
 * @property string|null $modified_user
 * @property int $role
 *
 * @property \App\Model\Entity\Report[] $report
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
        'account' => true,
        'password' => true,
        'name' => true,
        'email' => true,
        'tel' => true,
        'zipcode' => true,
        'address' => true,
        'created' => true,
        'modified' => true,
        'created_user' => true,
        'modified_user' => true,
        'role' => true,
        'report' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
