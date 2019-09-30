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
        $jwt = $this->auth();

        if(isset($jwt)){
            $jwt = JWT::encode($jwt,getenv("SECRET_KEY"));
            JWT::$leeway = 60;
            $res = array(
                "message"=>"User Acepted ",
                "jwt"=>$jwt
            );
            return $this->respondWithData($res);
        }else{
            return $this->respondWithData("hello from Containers");
        }


    }
}