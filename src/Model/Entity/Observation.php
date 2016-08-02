<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Observation Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $patient_id
 * @property \App\Model\Entity\Patient $patient
 */
class Observation extends Entity
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
