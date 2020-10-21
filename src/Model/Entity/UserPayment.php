<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPayment Entity
 *
 * @property string $id
 * @property string $user_package_line_id
 * @property string $documentno
 * @property string $payment_method
 * @property \Cake\I18n\FrozenDate $payment_date
 * @property string $image_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\UserPackageLine $user_package_line
 * @property \App\Model\Entity\Image $image
 */
class UserPayment extends Entity
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
        'user_package_line_id' => true,
        'documentno' => true,
        'payment_method' => true,
        'payment_date' => true,
        'image_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user_package_line' => true,
        'image' => true
    ];
}
