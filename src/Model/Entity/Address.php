<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property string $id
 * @property string $address1
 * @property string $address2
 * @property string $moo
 * @property string $soi
 * @property int $subdistrict_id
 * @property int $district_id
 * @property int $province_id
 * @property string $street
 * @property string $zipcode
 * @property \Cake\I18n\FrozenTime $created
 * @property string $description
 *
 * @property \App\Model\Entity\Subdistrict $subdistrict
 * @property \App\Model\Entity\District $district
 * @property \App\Model\Entity\Province $province
 * @property \App\Model\Entity\Asset[] $assets
 * @property \App\Model\Entity\UserAddress[] $user_addresses
 */
class Address extends Entity
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
        'address1' => true,
        'address2' => true,
        'moo' => true,
        'soi' => true,
        'subdistrict_id' => true,
        'district_id' => true,
        'province_id' => true,
        'street' => true,
        'zipcode' => true,
        'created' => true,
        'description' => true,
        'subdistrict' => true,
        'district' => true,
        'province' => true,
        'assets' => true,
        'user_addresses' => true
    ];
}
