<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property string $id
 * @property string $type
 * @property string $msg
 * @property string $status
 * @property string $to
 * @property string $to_user
 * @property string $from_user
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $asset_id
 *
 * @property \App\Model\Entity\Asset $asset
 */
class Message extends Entity
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
        'type' => true,
        'msg' => true,
        'status' => true,
        'to' => true,
        'to_user' => true,
        'from_user' => true,
        'created' => true,
        'modified' => true,
        'asset_id' => true,
        'asset' => true
    ];
}
