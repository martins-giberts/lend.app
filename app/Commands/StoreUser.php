<?php
namespace App\Commands;

use App\Models\User;

class StoreUser extends AbstractValidatingCommand
{

    /**
     * @var array
     */
	// TODO: Set equaly strong validation rules as in frontend
    protected $validationRules = [
        'ip' => 'required|integer|unique:users',
		'name' => 'required|max:255',
		'phone' => 'required|max:255',
		'iban' => 'required|max:255',
    ];

    public function execute()
    {
        $this->validate();

        return User::create($this->params);
    }

}
