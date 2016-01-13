<?php namespace App\Transformers;

use App\Models\LoanExtension;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ExtensionTransformer extends TransformerAbstract 
{
	public function transform(LoanExtension $extension)
    {
        return [
            'id' => $extension->id,
			'loan_id' => $extension->loan_id,
			'interest' => $extension->interest,
			'pay_back_date' => $extension->pay_back_date,
			'created_at' => $extension->created_at,
			'updated_at' => $extension->updated_at,
        ];
    }
}