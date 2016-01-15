<?php
namespace Api\Commands;

interface CommandInterface
{

    /**
     * @return mixed
     */
    public function execute();

}