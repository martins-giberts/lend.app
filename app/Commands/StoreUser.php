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
        'ip' => 'required|integer',
		'name' => 'required|max:255',
		'phone' => 'required|max:255',
		'iban' => 'required|max:255',
    ];
	
	// Join the phone and country code into one
	// Add Ip address as long
	public function setParams($params) 
	{
		// TODO: This should be wrapped in service.
		$params['ip'] = ip2long($_SERVER['REMOTE_ADDR']);
		$params['phone'] = trim($params['countryCode']) . trim($params['phone']);
		
		// Remove Country code
		unset($params['countryCode']);
		
		parent::setParams($params);
	}

    public function execute()
    {
        $this->validate();

        return User::findOrCreate($this->params);
    }
}
