<?php
namespace App\Commands;

use App\Exceptions\ValidationException;
use Illuminate\Validation\Validator;

abstract class AbstractValidatingCommand
{

    /**
     * @var array
     */
    protected $validationRules;

    /**
     * @var array
     */
    protected $params;

    /**
     * @return bool
     * @throws ValidationException
     */
    protected function validate()
    {
        /** @var Validator $validator */
        $validator = app('validator')->make($this->params, $this->validationRules);
        if (!$validator->passes()) {
            throw new ValidationException($validator->getMessageBag()->getMessages());
        }

        return true;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

}