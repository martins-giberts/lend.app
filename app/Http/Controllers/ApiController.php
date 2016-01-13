<?php namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;

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

	public function respondWithError(array $messages, $headers = [])
	{
		$data = [
			'status'=>'error',
			'messages'=>$messages,
		];

		return response()->json($data, $this->getStatusCode(), $headers);
	}
}
