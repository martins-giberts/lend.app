<?php
namespace App\Commands;

use App\Models\Loan;

class UpdateLoan extends AbstractValidatingCommand
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
    protected $loan;

    /**
     * @return User
     * @throws \App\Exceptions\ValidationException
     */
    public function execute()
    {
        $this->validate();

        $result = $this->loan->update($this->params);
        return $this->loan;
    }

    /**
     * @param User $user
     */
    public function setLoan($loan)
    {
        $this->loan = $loan;

        if ($this->loan) {
            foreach ($this->validationRules AS $field=>$rules) {
                $rules = str_replace('{id}', $this->loan->id, $rules);
                $this->validationRules[$field] = $rules;
            }
        }
    }

}