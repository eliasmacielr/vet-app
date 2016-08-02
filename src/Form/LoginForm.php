<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Login Form.
 */
class LoginForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param Schema $schema From schema
     * @return $this
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('email', ['type' => 'email', 'maxlength' => 255])
            ->addField('password', ['type' => 'password']);
    }

    /**
     * Form validation builder
     *
     * @param Validator $validator to use against the form
     * @return Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->email('email', false, 'Email ingresado es inválido')
            ->notEmpty('email');

        $validator
            ->notEmpty('password')
            ->minLength('password', 6, 'La contraseña debe tener almenos 6 caracteres');
        return $validator;
    }

    /**
     * Defines what to execute once the From is being processed
     *
     * @return bool
     */
    protected function _execute(array $data)
    {
        return true;
    }
}
