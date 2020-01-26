<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subdistrict Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_en
 * @property int $district_id
 * @property int $province_id
 * @property int $geoid
 *
 * @property \App\Model\Entity\District $district
 * @property \App\Model\Entity\Address[] $addresses
 */
class Subdistrict extends Entity
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
        'district_id' => true,
        'province_id' => true,
        'geoid' => true,
        'district' => true,
        'addresses' => true
    ];
}
