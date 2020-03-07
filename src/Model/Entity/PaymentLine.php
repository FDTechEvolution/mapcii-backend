<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentLine Entity
 *
 * @property string $id
 * @property string $documentno
 * @property string $payment_id
 * @property string $payment_method
 * @property \Cake\I18n\FrozenDate $payment_date
 * @property float $amount
 * @property string $package_name
 * @property string $package_duration
 * @property string $financial_account_id
 * @property string $image_id
 * @property string $description
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Payment $payment
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\FinancialAccount $financial_account
 * @property \App\Model\Entity\Image $image
 */
class PaymentLine extends Entity
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
        'documentno' => true,
        'payment_id' => true,
        'payment_method' => true,
        'payment_date' => true,
        'amount' => true,
        'package_name' => true,
        'package_duration' => true,
        'financial_account_id' => true,
        'image_id' => true,
        'description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'payment' => true,
        'package' => true,
        'financial_account' => true,
        'image' => true
    ];
}
