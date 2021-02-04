<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asset Entity
 *
 * @property string $id
 * @property string $code
 * @property string $announce
 * @property string $name
 * @property string $asset_type_id
 * @property string $user_id
 * @property float $floor
 * @property int $bedroom
 * @property int $bathroom
 * @property int $kitchenroom
 * @property int $receptionroom
 * @property int $diningroom
 * @property int $maidroom
 * @property int $parking
 * @property string $description
 * @property string $address_id
 * @property string $isactive
 * @property \Cake\I18n\FrozenDate $expire_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property float $landsize_1
 * @property float $landsize_2
 * @property float $landsize_3
 * @property float $usefulspace
 * @property string $type
 * @property int $total_publish_day
 * @property \Cake\I18n\FrozenDate $startdate
 * @property \Cake\I18n\FrozenDate $enddate
 * @property \Cake\I18n\FrozenTime $up_to_top
 * @property string $status
 * @property float $price
 * @property float $discount
 * @property float $rental
 * @property string $isnewproject
 * @property string $issales
 * @property string $isrent
 * @property string $reason_del
 *
 * @property \App\Model\Entity\AssetType $asset_type
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Address $address
 * @property \App\Model\Entity\AssetAd[] $asset_ads
 * @property \App\Model\Entity\AssetImage[] $asset_images
 * @property \App\Model\Entity\AssetOption[] $asset_options
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\UserFavorite[] $user_favorites
 */
class Asset extends Entity
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
        'announce' => true,
        'name' => true,
        'asset_type_id' => true,
        'user_id' => true,
        'floor' => true,
        'bedroom' => true,
        'bathroom' => true,
        'kitchenroom' => true,
        'receptionroom' => true,
        'diningroom' => true,
        'maidroom' => true,
        'parking' => true,
        'description' => true,
        'address_id' => true,
        'isactive' => true,
        'expire_date' => true,
        'created' => true,
        'modified' => true,
        'landsize_1' => true,
        'landsize_2' => true,
        'landsize_3' => true,
        'usefulspace' => true,
        'type' => true,
        'total_publish_day' => true,
        'startdate' => true,
        'enddate' => true,
        'up_to_top' => true,
        'status' => true,
        'price' => true,
        'discount' => true,
        'rental' => true,
        'isnewproject' => true,
        'issales' => true,
        'isrent' => true,
        'reason_del' => true,
        'asset_type' => true,
        'user' => true,
        'address' => true,
        'asset_ads' => true,
        'asset_images' => true,
        'asset_options' => true,
        'messages' => true,
        'user_favorites' => true
    ];
}
