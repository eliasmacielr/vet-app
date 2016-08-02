<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\Query;

/**
 * Searched behavior
 */
class SearchedBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function findSearched(Query $query, array $options)
    {
        $search = $options['search'];
        $fields = $options['searchFields'];
        if (!empty($search)) {
            foreach ($fields as $field) {
                $query->orWhere([$field . ' LIKE' => '%' . $search . '%']);
            }
        }
        return $query;
    }
}
