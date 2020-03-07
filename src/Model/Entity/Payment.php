<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $status
 * @property \Cake\I18n\FrozenDate $duration
 * @property string $package_id
 * @property float $package_amount
 * @property string $package_duration
 * @property string $isapproved
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Banner[] $banners
 * @property \App\Model\Entity\PaymentLine[] $payment_lines
 */
class Payment extends Entity
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
        'user_id' => true,
        'status' => true,
        'duration' => true,
        'package_id' => true,
        'package_amount' => true,
        'package_duration' => true,
        'isapproved' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'banners' => true,
        'payment_lines' => true
    ];
}
