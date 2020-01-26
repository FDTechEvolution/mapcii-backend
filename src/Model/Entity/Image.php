<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Image Entity
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $path
 * @property string $url
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\AssetImage[] $asset_images
 * @property \App\Model\Entity\AssetType[] $asset_types
 * @property \App\Model\Entity\Banner[] $banners
 * @property \App\Model\Entity\User[] $users
 */
class Image extends Entity
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
        'type' => true,
        'path' => true,
        'url' => true,
        'created' => true,
        'asset_images' => true,
        'asset_types' => true,
        'banners' => true,
        'users' => true
    ];
}
