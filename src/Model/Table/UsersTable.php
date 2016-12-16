<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Users Model
 *
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [
                    $this->aliasField('name'),
                    $this->aliasField('last_name'),
                    $this->aliasField('email'),
                ]
            ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Ya existe otro usuario con el mismo email'])
            ->maxLength('email', 255, 'El email debe tener como máximo 255 caracteres');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->maxLength('name', 50, 'El nombre debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->maxLength('last_name', 50, 'El apellido debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->minLength('password', 6, 'La contraseña debe tener almenos 6 caracteres')
            ->maxLength('password', 60, 'La contraseña debe tener como máximo 60 caracteres');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
                ->requirePresence('group_name', 'create')
                ->notEmpty('group_name');

        return $validator;
    }

    public function validationChangePassword(Validator $validator)
    {
        $validator
            ->notEmpty('old_password')
            ->minLength('old_password', 6, 'La contraseña debe tener almenos 6 caracteres')
            ->maxLength('old_password', 60, 'La contraseña debe tener como máximo 60 caracteres')
            ->add('old_password', 'custom', [
                'rule' => [$this, 'checkPassword'],
                'message' => 'La contraseña es incorrecta',
                'provider' => 'table',
            ]);

        $validator
            ->notEmpty('password')
            ->minLength('password', 6, 'La contraseña debe tener almenos 6 caracteres')
            ->maxLength('password', 60, 'La contraseña debe tener como máximo 60 caracteres')
            ->sameAs('password', 'repeat_new_password', 'Las contraseñas no coinciden');

        $validator
            ->notEmpty('repeat_new_password')
            ->minLength('repeat_new_password', 6, 'La contraseña debe tener almenos 6 caracteres')
            ->maxLength('repeat_new_password', 60, 'La contraseña debe tener como máximo 60 caracteres');

        return $validator;
    }

    public function validationProfile(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Ya existe otro usuario con el mismo email'])
            ->maxLength('email', 255, 'El email debe tener como máximo 255 caracteres');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->maxLength('name', 50, 'El nombre debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->maxLength('last_name', 50, 'El apellido debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password')
            ->minLength('confirm_password', 6, 'La contraseña debe tener almenos 6 caracteres')
            ->maxLength('confirm_password', 60, 'La contraseña debe tener como máximo 60 caracteres')
            ->add('confirm_password', 'custom', [
                'rule' => [$this, 'checkPassword'],
                'message' => 'La contraseña es incorrecta',
                'provider' => 'table',
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

    /**
     * Find users admin. Hide super-admin user and current user.
     *
     * @param  Query  $query
     * @param  array  $options
     * @return \Cake\ORM\Query
     */
    public function findAdmin(Query $query, array $options)
    {
        if ($options['user']['group_name'] === 'super-admin') {
            return $query->where([$this->aliasField('email').' !=' => 'super-admin@vetsystem.com'])->where([$this->aliasField('email').' !=' => $options['user']['email']]);
        } elseif ($options['user']['group_name'] === 'admin') {
            return $query->where([$this->aliasField('group_name').' !=' => 'super-admin'])->where([$this->aliasField('email').' !=' => $options['user']['email']]);;
        }
        return $query->where([$this->aliasField('group_name').' !=' => 'super-admin'])->where([$this->aliasField('group_name').' !=' => 'admin'])->where([$this->aliasField('email').' !=' => $options['user']['email']]);
    }

    /**
     * Authentication finder.
     *
     * @param \Cake\ORM\Query $query
     * @param array $options
     * @return \Cake\ORM\Query
     */
    public function findAuth(Query $query, array $options)
    {
        return $query->where(['active' => true]);
    }

    public function checkPassword($password, array $context)
    {
        $oldPassword = $context['providers']['passed']['userPassword'];
        $hasher = new DefaultPasswordHasher();
        return $hasher->check($password, $oldPassword);
    }
}
