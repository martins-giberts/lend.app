<?php

# app/Models/Quote.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class User extends Model  
{
	protected $fillable = array('name', 'ip', 'phone', 'iban');
	
	public static function findOrCreate($attributes)
	{
		$user = static::findByIp($attributes['ip']);
		if ($user !== null)
		{
			return $user;
		}
		
		static::create($attributes);
	}
	
	public static function findByIp($ip)
	{
		// Check if IP is already converted to int
		if (!is_int($ip))
		{
			$ip = ip2long($ip);
		}
		
		return self::where('ip', '=', (int) $ip)->first();
	}
	
	public static function getCurrent()
	{
		// TODO: Implement $_SERVER fascade or wrapper
		return self::findByIp(ip2long($_SERVER['REMOTE_ADDR']));
	}
	
	public function loans()
	{
		return $this->hasMany('App\Models\Loan', 'user_id');
	}
}