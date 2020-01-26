<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property string $id
 * @property string $usercode
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $lineid
 * @property string $fax
 * @property string $isactive
 * @property string $isverify
 * @property string $islocked
 * @property string $iscustomer
 * @property string $isseller
 * @property string $gender
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 * @property string $verifycode
 * @property string $position
 * @property string $image_id
 *
 * @property \App\Model\Entity\Image $image
 * @property \App\Model\Entity\Asset[] $assets
 * @property \App\Model\Entity\UserAddress[] $user_addresses
 * @property \App\Model\Entity\UserPackage[] $user_packages
 */
class User extends Entity
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
        'usercode' => true,
        'title' => true,
        'firstname' => true,
        'lastname' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'phone' => true,
        'lineid' => true,
        'fax' => true,
        'isactive' => true,
        'isverify' => true,
        'islocked' => true,
        'iscustomer' => true,
        'isseller' => true,
        'gender' => true,
        'created' => true,
        'updated' => true,
        'verifycode' => true,
        'position' => true,
        'image_id' => true,
        'image' => true,
        'assets' => true,
        'user_addresses' => true,
        'user_packages' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
     protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
