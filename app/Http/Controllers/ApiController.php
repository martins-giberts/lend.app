<?php namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Input;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiController extends Controller {

	protected $statusCode = IlluminateResponse::HTTP_OK;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	public function respond($data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	
	public function respondWithItem(Item $item, $headers = [])
	{
		$fractal = new Manager();
		$data = $fractal->createData($item)->toArray();
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	
	public function respondWithCollection(Collection $collection, $headers = [])
	{
		$fractal = new Manager();
		$data = $fractal->createData($collection)->toArray();
		return response()->json($data, $this->getStatusCode(), $headers);
	}
	
	public function respondWithArray(array $data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError(array $messages, $headers = [])
	{
		$data = [
			'status'=>'error',
			'messages'=>$messages,
		];

		return response()->json($data, $this->getStatusCode(), $headers);
	}
}
