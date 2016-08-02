<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Number;

/**
 * Customer Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $phone_other
 * @property string $address
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $location_id
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Patient[] $patients
 */
class Customer extends Entity
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
        '*' => true,
        'id' => false,
    ];

    public function _getFullNameList()
    {
        return Number::format($this->_properties['id']) . ' - ' . $this->_properties['name'] . ' ' . $this->_properties['last_name'];
    }
}
