<?php namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Commands\StoreLoan;
use App\Commands\StoreUser;
use App\Commands\UpdateLoan;
use App\Commands\UpdateUser;
use App\Transformers\LoanTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use \App\Exceptions\ValidationException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Input;

class LoanController extends ApiController 
{
	/**
	 * @var Loan
	 */
	protected $loan;
	/**
	 * @var LoanTransformer
	 */
	protected $loanTransformer;
	
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var LoanTransformer
	 */
	protected $userTransformer;

	function __construct(Loan $loan, User $user, LoanTransformer $loanTransformer, UserTransformer $userTransformer)
	{
		$this->loan = $loan;
		$this->loanTransformer = $loanTransformer;
		
		$this->user = $user;
		$this->userTransformer = $userTransformer;
	}

	public function index(Manager $fractal, LoanTransformer $loanTransformer)
	{
		// TODO: Add User data and filter by user data
		$loans = $this->loan->with(['extensions', 'user'])->get();
		$collection = new Collection($loans, $loanTransformer);
		$data = $fractal->createData($collection)->toArray();

		return $this->respond($data);
	}

	public function show($id)
	{
		try 
		{
			$loan = $this->loan->findOrFail($id);
			$item = new Item($loan, $this->loanTransformer);
			return $this->respondWithItem($item);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['Loan does not exist']);
		}
	}
	
	public function store(Request $request)
	{
		try 
		{
			$this->storeUser($request);
			return $this->storeLoan($request);
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
	
	function storeLoan(Request $request)
	{
		$command = new StoreLoan();
		$command->setParams($request->json('loan'));
		$loan = $command->execute();
		$item = new Item($loan, $this->loanTransformer);
		return $this->respondWithItem($item);
	}
	
	public function update($id, Request $request)
	{
		try 
		{
			$loan = $this->loan->findOrFail($id);
			$command = new UpdateLoan();
			$command->setLoan($loan);
			$command->setParams($request->json()->all());
			$loan = $command->execute();
			$item = new Item($loan, $this->loanTransformer);
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
			return $this->respondWithError(['Loan does not exist']);
		}
	}
	
	public function destroy($id)
	{
		try 
		{
			$loan = $this->loan->findOrFail($id);
			$loan->delete();
			return $this->respondWithArray([
				'status' => 'success',
			]);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['Loan does not exist']);
		}
	}
}
//
//namespace App\Http\Controllers;
//
//use App\Commands\StoreLoan;
//use App\Commands\UpdateLoan;
//use App\Exceptions\ValidationException;
//use App\Models\Loan;
//use App\Transformers\LoanTransformer;
//use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Http\Request;
//use Illuminate\Http\Response as IlluminateResponse;
//use Illuminate\Support\Facades\Input;
//use League\Fractal\Resource\Collection;
//use League\Fractal\Resource\Item;
//
//class LoanController extends ApiController
//{
//	/**
//	 * @var Loan
//	 */
//	protected $loan;
//	/**
//	 * @var LoanTransformer
//	 */
//	protected $transformer;
//	/**
//	 * @param Loan $loan
//	 */
//	function __construct(Loan $loan, LoanTransformer $transformer)
//	{
//		$this->loan = $loan;
//		$this->transformer = $transformer;
//	}
//	/**
//	 * @param Input $input
//	 * @return \Symfony\Component\HttpFoundation\Response
//	 */
//	public function index(Input $input)
//	{
//		$paginator = $this->generatePaginator($this->loan, $input);
//		$loans = $paginator->getCollection();
//		$resource = new Collection($loans, $this->transformer);
//		return $this->respondWithCollection($resource, $paginator);
//	}
//	/**
//	 * @param $id
//	 * @return \Symfony\Component\HttpFoundation\Response
//	 */
//	public function show($id)
//	{
//		try 
//		{
//			$loan = $this->loan->findOrFail($id);
//			$item = new Item($loan, $this->transformer);
//			return $this->respondWithItem($item);
//		}
//		catch (ModelNotFoundException $e) 
//		{
//			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
//			return $this->respondWithError(['Loan does not exist']);
//		}
//	}
//	/**
//	 * @param Request $request
//	 * @return \Symfony\Component\HttpFoundation\Response
//	 */
//	public function store(Request $request)
//	{
//		try 
//		{
//			$command = new StoreLoan();
//			$command->setParams($request->json()->all());
//			$loan = $command->execute();
//			$item = new Item($loan, $this->transformer);
//			return $this->respondWithItem($item);
//		}
//		catch (ValidationException $e) 
//		{
//			$this->statusCode = IlluminateResponse::HTTP_NOT_ACCEPTABLE;
//			return $this->respondWithError($e->getMessages());
//		}
//	}
//	/**
//	 * @param $id
//	 * @param Request $request
//	 * @return \Symfony\Component\HttpFoundation\Response
//	 */
//	public function update($id, Request $request)
//	{
//		try 
//		{
//			$loan = $this->loan->findOrFail($id);
//			$command = new UpdateLoan();
//			$command->setLoan($loan);
//			$command->setParams($request->json()->all());
//			$loan = $command->execute();
//			$item = new Item($loan, $this->transformer);
//			return $this->respondWithItem($item);
//		}
//		catch (ValidationException $e) 
//		{
//			$this->statusCode = IlluminateResponse::HTTP_NOT_ACCEPTABLE;
//			return $this->respondWithError($e->getMessages());
//		}
//		catch (ModelNotFoundException $e) 
//		{
//			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
//			return $this->respondWithError(['Loan does not exist']);
//		}
//	}
//	public function destroy($id)
//	{
//		try 
//		{
//			$loan = $this->loan->findOrFail($id);
//			$loan->delete();
//			return $this->respondWithArray([
//				'status' => 'success',
//			]);
//		}
//		catch (ModelNotFoundException $e) 
//		{
//			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
//			return $this->respondWithError(['Loan does not exist']);
//		}
//	}
//}
