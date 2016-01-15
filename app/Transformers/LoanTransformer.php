<?php namespace App\Transformers;

use App\Models\Loan;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;
//use App\Transformers\ExtensionTransformer;

class LoanTransformer extends TransformerAbstract 
{
	protected $defaultIncludes = [
		'extensions',
	];

	public function transform(Loan $loan)
	{
		return [
			'id' => $loan->id,
			'userId' => $loan->user_id,
			'ammount' => $loan->ammount,
			'commision' => $loan->interest,
			'date' => $loan->pay_back_date,
			'updated' => $loan->updated_at->format('Y-m-d H:i:s'),
			'created' => $loan->created_at->format('Y-m-d H:i:s'),
		];
	}

	public function includeExtensions(Loan $loan)
	{
		$extensions = $loan->extensions;

		return $this->collection($extensions, new ExtensionTransformer);
	}
	
	public function includeUser(Loan $loan)
	{
		$user = $loan->user;
		return $this->item($user, new UserTransformer);
	}
}