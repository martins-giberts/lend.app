<?php namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract 
{
	protected $defaultIncludes = [
		'loans',
	];
	
	public function transform(User $user)
    {
        return [
            'id' => $user->id,
			'ip' => long2ip($user->ip),
			'name' => $user->name,
			'phone' => $user->phone,
			'iban' => $user->iban,
			'created' => $user->created_at->format('F d, Y'),
			'updated' => $user->updated_at->format('F d, Y'),
        ];
    }
	
	public function includeLoans(User $user)
	{
		$loans = $user->loans;

		return $this->collection($loans, new LoanTransformer);
	}
}