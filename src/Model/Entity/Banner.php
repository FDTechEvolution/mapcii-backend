<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property string $id
 * @property string $type
 * @property string $user_id
 * @property string $user_package_id
 * @property string $topic
 * @property string $description
 * @property string $image_id
 * @property string $isapproved
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $createdby
 * @property string $reason_del
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserPackage $user_package
 * @property \App\Model\Entity\Image $image
 * @property \App\Model\Entity\BannerLine[] $banner_lines
 */
class Banner extends Entity
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
        'type' => true,
        'user_id' => true,
        'user_package_id' => true,
        'topic' => true,
        'description' => true,
        'image_id' => true,
        'isapproved' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'reason_del' => true,
        'user' => true,
        'user_package' => true,
        'image' => true,
        'banner_lines' => true
    ];
}
