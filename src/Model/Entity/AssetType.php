<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetType Entity
 *
 * @property string $id
 * @property string $name
 * @property string $image_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $seq
 * @property string $asset_category_id
 *
 * @property \App\Model\Entity\Image $image
 * @property \App\Model\Entity\AssetCategory $asset_category
 * @property \App\Model\Entity\Asset[] $assets
 */
class AssetType extends Entity
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
        'name' => true,
        'image_id' => true,
        'created' => true,
        'modified' => true,
        'seq' => true,
        'asset_category_id' => true,
        'image' => true,
        'asset_category' => true,
        'assets' => true
    ];
}
