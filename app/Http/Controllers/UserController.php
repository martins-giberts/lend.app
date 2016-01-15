<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Commands\StoreUser;
use App\Commands\UpdateUser;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use \App\Exceptions\ValidationException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as IlluminateResponse;

class UserController extends ApiController
{
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var UserTransformer
	 */
	protected $userTransformer;

	function __construct(User $user, UserTransformer $userTransformer)
	{
		$this->user = $user;
		$this->userTransformer = $userTransformer;
	}

	// Return current user
	public function index(Manager $fractal, UserTransformer $userTransformer)
	{
		try 
		{
			$user = $this->user;
			$item = new Item($user::getCurrent(), $userTransformer);
			return $this->respondWithItem($item);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['User does not exist']);
		}
	}

	public function show($id)
	{
		try 
		{
			$user = $this->user->findOrFail($id);
			$item = new Item($user, $this->userTransformer);
			return $this->respondWithItem($item);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['User does not exist']);
		}
	}
	
	public function store(Request $request)
	{
		try 
		{
			return $this->storeUser($request);
		}
		catch (ValidationException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_ACCEPTABLE;
			return $this->respondWithError($e->getMessages());
		}
	}
	
	function storeUser(Request $request)
	{
		$command = new StoreUser();
		$command->setParams($request->json('user'));
		$user = $command->execute();
		$item = new Item($user, $this->userTransformer);
		return $this->respondWithItem($item);
	}
	
	public function update($id, Request $request)
	{
		try 
		{
			$user = $this->user->findOrFail($id);
			$command = new UpdateUser();
			$command->setUser($user);
			$command->setParams($request->json()->all());
			$user = $command->execute();
			$item = new Item($user, $this->userTransformer);
			return $this->respondWithItem($item);
		}
		catch (ValidationException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_ACCEPTABLE;
			return $this->respondWithError($e->getMessages());
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['User does not exist']);
		}
	}
	
	public function destroy($id)
	{
		try 
		{
			$user = $this->user->findOrFail($id);
			$user->delete();
			return $this->respondWithArray([
				'status' => 'success',
			]);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['User does not exist']);
		}
	}
}
