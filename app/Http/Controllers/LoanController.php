<?php

namespace App\Http\Controllers;

use App\Commands\StoreLoan;
use App\Commands\UpdateLoan;
use App\Exceptions\ValidationException;
use App\Models\Loan;
use App\Transformers\LoanTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Input;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class LoanController extends ApiController
{
	/**
	 * @var Loan
	 */
	protected $loan;
	/**
	 * @var LoanTransformer
	 */
	protected $transformer;
	/**
	 * @param Loan $loan
	 */
	function __construct(Loan $loan, LoanTransformer $transformer)
	{
		$this->loan = $loan;
		$this->transformer = $transformer;
	}
	/**
	 * @param Input $input
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(Input $input)
	{
		$paginator = $this->generatePaginator($this->loan, $input);
		$loans = $paginator->getCollection();
		$resource = new Collection($loans, $this->transformer);
		return $this->respondWithCollection($resource, $paginator);
	}
	/**
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show($id)
	{
		try 
		{
			$loan = $this->loan->findOrFail($id);
			$item = new Item($loan, $this->transformer);
			return $this->respondWithItem($item);
		}
		catch (ModelNotFoundException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_FOUND;
			return $this->respondWithError(['Loan does not exist']);
		}
	}
	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function store(Request $request)
	{
		try 
		{
			$command = new StoreLoan();
			$command->setParams($request->json()->all());
			$loan = $command->execute();
			$item = new Item($loan, $this->transformer);
			return $this->respondWithItem($item);
		}
		catch (ValidationException $e) 
		{
			$this->statusCode = IlluminateResponse::HTTP_NOT_ACCEPTABLE;
			return $this->respondWithError($e->getMessages());
		}
	}
	/**
	 * @param $id
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update($id, Request $request)
	{
		try 
		{
			$loan = $this->loan->findOrFail($id);
			$command = new UpdateLoan();
			$command->setLoan($loan);
			$command->setParams($request->json()->all());
			$loan = $command->execute();
			$item = new Item($loan, $this->transformer);
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