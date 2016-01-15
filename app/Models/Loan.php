<?php

# app/Models/Quote.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Loan extends Model  
{
	protected $fillable = array('user_id', 'ammount', 'interest', 'pay_back_date');
	
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
	
	public function extensions()
	{
		return $this->hasMany('App\Models\LoanExtension', 'loan_id');
	}
}