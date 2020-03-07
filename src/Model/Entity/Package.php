<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $monthly_price
 * @property float $quarterly_price
 * @property float $semiannual_price
 * @property float $annual_price
 * @property string $showpage
 * @property string $showcase
 * @property string $size_id
 * @property string $position_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $createdby
 *
 * @property \App\Model\Entity\Size $size
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\UserPackage[] $user_packages
 */
class Package extends Entity
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
        'name' => true,
        'description' => true,
        'monthly_price' => true,
        'quarterly_price' => true,
        'semiannual_price' => true,
        'annual_price' => true,
        'showpage' => true,
        'showcase' => true,
        'size_id' => true,
        'position_id' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'size' => true,
        'payments' => true,
        'user_packages' => true
    ];
}
