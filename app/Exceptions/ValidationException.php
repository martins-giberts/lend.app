<?php
namespace App\Exceptions;

class ValidationException extends \Exception
{

    /**
     * @var array
     */
    protected $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

}