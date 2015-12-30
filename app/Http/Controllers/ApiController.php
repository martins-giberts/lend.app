<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Input;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiController extends Controller
{
	/**
	 * @var int
	 */
	protected $statusCode = IlluminateResponse::HTTP_OK;
	/**
	 * @return int
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}
	/**
	 * @param $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}
	/**
	 * @param Model $model
	 * @param Input $input
	 * @return Paginator
	 */
	protected function generatePaginator(Model $model, Input $input)
	{
		$paginator = $model->orderby($input->get('sortBy','id'), $input->get('sortDir','ASC'))->paginate();
		$queryParams = array_diff_key($input->get(), array_flip(['page']));
		foreach ($queryParams as $key => $value) 
		{
			$paginator->addQuery($key, $value);
		}
		return $paginator;
	}
	/**
	 * @param Item $item
	 * @param array $headers
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function respondWithItem(Item $item, $headers = [])
	{
		$fractal = new Manager();
		$data = $fractal->createData($item)->toArray();
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	/**
	 * @param Collection $collection
	 * @param Paginator|null $paginator
	 * @param array $headers
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function respondWithCollection(Collection $collection, Paginator $paginator=null, $headers = [])
	{
		if ($paginator) 
		{
			$paginatorAdapter = new IlluminatePaginatorAdapter($paginator);
			$collection->setPaginator($paginatorAdapter);
		}
		$fractal = new Manager();
		$data = $fractal->createData($collection)->toArray();
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	/**
	 * @param array $messages
	 * @param array $headers
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function respondWithError(array $messages, $headers = [])
	{
		$data = [
			'status'=>'error',
			'messages'=>$messages,
		];
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	/**
	 * @param array $data
	 * @param array $headers
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function respondWithArray(array $data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}
}