<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property string $id
 * @property string $full_name
 * @property string $tel
 * @property string $email
 * @property string $message
 * @property \Cake\I18n\FrozenTime $created
 * @property string $createdby
 */
class Contact extends Entity
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
        'full_name' => true,
        'tel' => true,
        'email' => true,
        'message' => true,
        'created' => true,
        'createdby' => true
    ];
}
