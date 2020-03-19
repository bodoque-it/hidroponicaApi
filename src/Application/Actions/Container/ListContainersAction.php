<?php


namespace App\Application\Actions\Container;
use App\Application\Actions\Container\ContainerAction;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Firebase\JWT\JWT;

class ListContainersAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id = $this->resolveArg("id");
/*
        $jwt = $this->auth();

        if(isset($jwt)){
            $result = $this->containerRepository->findAll();
            $res = array(
                "jwt"=>$jwt,
                "container"=>$result
            );
            return $this->respondWithData($res);*/
        $result = $this->containerRepository->findAll($id);
        return $this->respondWithData($result);
        /*}else{
            return $this->respondWithError(401,"Access Denied");
        }*/


    }
}