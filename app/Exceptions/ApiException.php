<?php


namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use App\Http\Response\ErrorResponse;

class ApiException extends \Exception
{
    public function render(): ErrorResource
    {
        $error = new ErrorResponse($this->getCode(), $this->getMessage());
        return new ErrorResource($error);
    }
}
