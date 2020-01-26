<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property string $id
 * @property string $type
 * @property string $user_id
 * @property string $image_id
 * @property string $description
 * @property string $position
 * @property string $isactive
 * @property string $isapproved
 * @property \Cake\I18n\FrozenTime $created
 * @property string $createdby
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Image $image
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
        'image_id' => true,
        'description' => true,
        'position' => true,
        'isactive' => true,
        'isapproved' => true,
        'created' => true,
        'createdby' => true,
        'user' => true,
        'image' => true
    ];
}
