<?php namespace App\Transformers;

use App\Models\User;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract 
{
	public function transform(User $user)
    {
        return [
            'id' => $user->id,
			'ip' => $user->ip,
			'name' => $user->name,
			'phone' => $user->phone,
			'iban' => $user->iban,
			'created' => $user->created_at->format('F d, Y'),
			'updated' => $loan->updated_at->format('F d, Y'),
        ];
    }
}