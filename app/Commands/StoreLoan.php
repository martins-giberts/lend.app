<?php
namespace App\Commands;

use App\Models\Loan;

class StoreLoan extends AbstractValidatingCommand
{

    /**
     * @var array
     */	
    protected $validationRules = [
        'user_id'=>'required|integer',
        'ammount'=>'required|numeric',
        'interest'=>'required|numeric',
        'pay_back_date'=>'required|date',
    ];
	
	public function setParams($params) 
	{	
		// TODO: This should be wrapped in service.
		$ip = ip2long($_SERVER['REMOTE_ADDR']);
		
		// TODO: find users by IP only for now
		// TODO: Check if user is not null (Just in case) since we should always 99.9999998% of times have User ready to go
		$user = \App\Models\User::findByIp($ip);
		$attributes = [
			'user_id' => $user->id, 
			'ammount' => (int) $params['ammount'], 
			'interest' => (float) $params['commision'], 
			'pay_back_date' => $params['date'],
		];
		
		parent::setParams($attributes);
	}

    public function execute()
    {
        $this->validate();

        return Loan::create($this->params);
    }

}