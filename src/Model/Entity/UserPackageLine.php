<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPackageLine Entity
 *
 * @property string $id
 * @property string $user_package_id
 * @property string $package_line_id
 * @property string $package_name
 * @property string $size
 * @property string $order_code
 * @property float $price
 * @property int $credit
 * @property \Cake\I18n\FrozenDate $buy_date
 * @property \Cake\I18n\FrozenDate $paid_date
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $ispaid
 * @property string $isexpire
 * @property string $duration_name
 * @property int $duration
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\UserPackage $user_package
 * @property \App\Model\Entity\UserPayment[] $user_payments
 */
class UserPackageLine extends Entity
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
        'user_package_id' => true,
        'package_line_id' => true,
        'package_name' => true,
        'size' => true,
        'order_code' => true,
        'price' => true,
        'credit' => true,
        'buy_date' => true,
        'paid_date' => true,
        'start_date' => true,
        'end_date' => true,
        'ispaid' => true,
        'isexpire' => true,
        'duration_name' => true,
        'duration' => true,
        'created' => true,
        'modified' => true,
        'user_package' => true,
        'user_payments' => true
    ];
}
