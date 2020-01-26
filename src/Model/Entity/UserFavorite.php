<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserFavorite Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $asset_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $description
 * @property string $isactive
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Asset $asset
 */
class UserFavorite extends Entity
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
        'asset_id' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'isactive' => true,
        'user' => true,
        'asset' => true
    ];
}
