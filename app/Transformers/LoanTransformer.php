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
			'user_id' => $loan->user_id,
			'ammount' => $loan->ammount,
			'interest' => $loan->interest,
			'pay_back_date' => $loan->pay_back_date,
			'updated' => $loan->updated_at->format('F d, Y'),
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