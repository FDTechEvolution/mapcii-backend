<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPackage Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $package_id
 * @property string $plant
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property string $isexpire
 * @property string $ispaid
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $description
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Package $package
 */
class UserPackage extends Entity
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
        'package_id' => true,
        'plant' => true,
        'start_date' => true,
        'end_date' => true,
        'isexpire' => true,
        'ispaid' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'user' => true,
        'package' => true
    ];
}
