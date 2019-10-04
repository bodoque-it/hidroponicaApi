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
        $jwt = $this->auth();
        $res = array();
        if(isset($jwt)){
            $res["result"] = "logout";
        }else{
            $res["result"] = "Wtf Men";
        }
        return $this->respondWithData($res);
    }
}