<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetCategory Entity
 *
 * @property string $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $seq
 *
 * @property \App\Model\Entity\AssetType[] $asset_types
 */
class AssetCategory extends Entity
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
        'created' => true,
        'modified' => true,
        'seq' => true,
        'asset_types' => true
    ];
}
