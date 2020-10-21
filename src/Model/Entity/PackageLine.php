<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PackageLine Entity
 *
 * @property string $id
 * @property string $package_id
 * @property string $size_id
 * @property float $isprice
 * @property int $iscredit
 * @property float $proprice
 * @property int $procredit
 * @property string $package_duration_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\PackageDuration $package_duration
 */
class PackageLine extends Entity
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
        'package_id' => true,
        'size_id' => true,
        'isprice' => true,
        'iscredit' => true,
        'proprice' => true,
        'procredit' => true,
        'package_duration_id' => true,
        'created' => true,
        'modified' => true,
        'package' => true,
        'package_duration' => true
    ];
}
