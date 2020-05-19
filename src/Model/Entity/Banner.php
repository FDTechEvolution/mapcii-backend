<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property string $id
 * @property string $type
 * @property string $user_id
 * @property string $payment_id
 * @property string $description
 * @property string $position_id
 * @property string $isapproved
 * @property int $limit
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $createdby
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Payment $payment
 * @property \App\Model\Entity\Position $position
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
        'payment_id' => true,
        'description' => true,
        'position_id' => true,
        'isapproved' => true,
        'limit' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'user' => true,
        'payment' => true,
        'position' => true,
        'banner_lines' => true
    ];
}
