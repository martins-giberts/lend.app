<?php
namespace App\Commands;

use App\Models\User;

class UpdateUser extends AbstractValidatingCommand
{

    /**
     * @var array
     */
    protected $validationRules = [
        'username'=>'unique:users,username,{id}|max:255',
        'email'=>'unique:users,email,{id}|max:255|email',
        'password'=>'max:255',
        'firstname'=>'max:255',
        'lastname'=>'max:255',
    ];

    /**
     * @var User
     */
    protected $user;

    /**
     * @return User
     * @throws \App\Exceptions\ValidationException
     */
    public function execute()
    {
        $this->validate();

        $result = $this->user->update($this->params);
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        if ($this->user) {
            foreach ($this->validationRules AS $field=>$rules) {
                $rules = str_replace('{id}', $this->user->id, $rules);
                $this->validationRules[$field] = $rules;
            }
        }
    }

}