<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $isprice
 * @property int $isqty
 * @property float $proprice
 * @property int $proqty
 * @property string $showpage
 * @property string $showcase
 * @property string $size_id
 * @property string $package_duration_id
 * @property string $package_type_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $createdby
 *
 * @property \App\Model\Entity\Size $size
 * @property \App\Model\Entity\PackageDuration $package_duration
 * @property \App\Model\Entity\PackageType $package_type
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
        'isprice' => true,
        'isqty' => true,
        'proprice' => true,
        'proqty' => true,
        'showpage' => true,
        'showcase' => true,
        'size_id' => true,
        'package_duration_id' => true,
        'package_type_id' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'size' => true,
        'package_duration' => true,
        'package_type' => true,
        'payments' => true,
        'user_packages' => true
    ];
}
