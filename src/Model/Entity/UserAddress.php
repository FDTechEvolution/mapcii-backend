<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAddress Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $address_id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $description
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Address $address
 */
class UserAddress extends Entity
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
        'address_id' => true,
        'created' => true,
        'description' => true,
        'user' => true,
        'address' => true
    ];
}
