<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SequentNumber Entity
 *
 * @property string $id
 * @property string $prefix
 * @property string $suffix
 * @property int $start_no
 * @property int $current_no
 * @property int $running_length
 * @property string $current_sequent
 * @property \Cake\I18n\FrozenTime $created
 */
class SequentNumber extends Entity
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
        'prefix' => true,
        'suffix' => true,
        'start_no' => true,
        'current_no' => true,
        'running_length' => true,
        'current_sequent' => true,
        'created' => true
    ];
}
