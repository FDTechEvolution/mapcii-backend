<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * District Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_en
 * @property int $geoid
 * @property int $province_id
 *
 * @property \App\Model\Entity\Province $province
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\Subdistrict[] $subdistricts
 */
class District extends Entity
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
        'code' => true,
        'name' => true,
        'name_en' => true,
        'geoid' => true,
        'province_id' => true,
        'province' => true,
        'addresses' => true,
        'subdistricts' => true
    ];
}
