<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $sex
 * @property \Cake\I18n\Time $birthday
 * @property string $coat
 * @property string $color
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $breed_id
 * @property \App\Model\Entity\Breed $breed
 * @property int $customer_id
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Observation[] $observations
 * @property \App\Model\Entity\Vaccination[] $vaccinations
 */
class Patient extends Entity
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
}
