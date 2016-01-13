<?php
namespace App\Commands;

use App\Models\Loan;

class StoreLoan extends AbstractValidatingCommand
{

    /**
     * @var array
     */
    protected $validationRules = [
        'username'=>'required|unique:users|max:255',
        'email'=>'required|unique:users|max:255|email',
        'password'=>'required|max:255',
        'firstname'=>'required|max:255',
        'lastname'=>'required|max:255',
    ];

    public function execute()
    {
        $this->validate();

        return User::create($this->params);
    }

}