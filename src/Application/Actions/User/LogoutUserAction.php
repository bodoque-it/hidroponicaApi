<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class LogoutUserAction extends UserAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        if($this->request->hasHeader('Authorization')){
            $this->response = $this->response->withoutHeader('Authorization');
        }
        return $this->respondWithData("Your are logged out");
    }
}