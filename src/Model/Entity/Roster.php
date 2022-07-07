<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Roster Entity
 *
 * @property int $id
 * @property int $users_id
 * @property \Cake\I18n\FrozenTime|null $start_time
 * @property \Cake\I18n\FrozenTime|null $end_time
 * @property int $status
 * @property string $reason
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $created_user
 * @property string|null $modified_user
 *
 * @property \App\Model\Entity\User $user
 */
class Roster extends Entity
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
        'users_id' => true,
        'start_time' => true,
        'end_time' => true,
        'status' => true,
        'reason' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'created_user' => true,
        'modified_user' => true,
        'user' => true,
    ];
}
