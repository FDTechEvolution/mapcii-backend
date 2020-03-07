<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BannerLine Entity
 *
 * @property string $id
 * @property string $banner_id
 * @property string $image_id
 * @property string $isactive
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Banner $banner
 * @property \App\Model\Entity\Image $image
 */
class BannerLine extends Entity
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
        'banner_id' => true,
        'image_id' => true,
        'isactive' => true,
        'created' => true,
        'modified' => true,
        'banner' => true,
        'image' => true
    ];
}
