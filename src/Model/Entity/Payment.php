<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property string $id
 * @property string $documentno
 * @property \Cake\I18n\FrozenTime $paymentdate
 * @property string $payment_method
 * @property string $user_id
 * @property float $amount
 * @property string $status
 * @property string $isapproved
 * @property string $financial_account_id
 * @property string $payment_slip
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FinancialAccount $financial_account
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
        'documentno' => true,
        'paymentdate' => true,
        'payment_method' => true,
        'user_id' => true,
        'amount' => true,
        'status' => true,
        'isapproved' => true,
        'financial_account_id' => true,
        'payment_slip' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'financial_account' => true
    ];
}
