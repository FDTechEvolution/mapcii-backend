<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetAd Entity
 *
 * @property string $id
 * @property string $asset_id
 * @property string $payment_id
 * @property string $position_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Asset $asset
 * @property \App\Model\Entity\Payment $payment
 */
class AssetAd extends Entity
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
        'asset_id' => true,
        'payment_id' => true,
        'position_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'asset' => true,
        'payment' => true
    ];
}
