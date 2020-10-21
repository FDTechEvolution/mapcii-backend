<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PackageDuration Entity
 *
 * @property string $id
 * @property string $duration_name
 * @property int $duration_exp
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class PackageDuration extends Entity
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
        'duration_name' => true,
        'duration_exp' => true,
        'created' => true,
        'modified' => true
    ];
}
