<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetImage Entity
 *
 * @property string $id
 * @property string $asset_id
 * @property string $image_id
 * @property string $isdefault
 * @property \Cake\I18n\FrozenTime $created
 * @property int $seq
 *
 * @property \App\Model\Entity\Asset $asset
 * @property \App\Model\Entity\Image $image
 */
class AssetImage extends Entity
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
        'image_id' => true,
        'isdefault' => true,
        'created' => true,
        'seq' => true,
        'asset' => true,
        'image' => true
    ];
}
