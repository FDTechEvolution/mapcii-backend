<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appsetting Entity
 *
 * @property string $id
 * @property string $email_receiver_contact
 * @property string $email_receiver_seller
 * @property string $email_receiver_purchase
 * @property \Cake\I18n\FrozenTime $created
 */
class Appsetting extends Entity
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
        'email_receiver_contact' => true,
        'email_receiver_seller' => true,
        'email_receiver_purchase' => true,
        'created' => true
    ];
}
