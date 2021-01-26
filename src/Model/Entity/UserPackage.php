<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPackage Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $order_code
 * @property int $duration
 * @property int $credit
 * @property int $used
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $isexpire
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $description
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AssetAd[] $asset_ads
 * @property \App\Model\Entity\UserPackageLine[] $user_package_lines
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
        'order_code' => true,
        'duration' => true,
        'credit' => true,
        'used' => true,
        'start_date' => true,
        'end_date' => true,
        'isexpire' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'user' => true,
        'asset_ads' => true,
        'user_package_lines' => true
    ];
}
