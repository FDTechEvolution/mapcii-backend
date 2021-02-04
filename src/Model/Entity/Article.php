<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $image_id
 * @property string $user_id
 * @property string $short_content
 * @property string $isactive
 *
 * @property \App\Model\Entity\Image $image
 */
class Article extends Entity
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
        'title' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        'image_id' => true,
        'user_id' => true,
        'short_content' => true,
        'isactive' => true,
        'image' => true
    ];
}
