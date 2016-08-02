<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vaccination Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $vaccination_date
 * @property \Cake\I18n\Time $revaccination
 * @property bool $revaccinated
 * @property string $annotations
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $vaccine_id
 * @property \App\Model\Entity\Vaccine $vaccine
 * @property int $patient_id
 * @property \App\Model\Entity\Patient $patient
 */
class Vaccination extends Entity
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
