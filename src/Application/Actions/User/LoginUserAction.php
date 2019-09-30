<?php


namespace App\Application\Actions\User;


use App\Application\Actions\Action;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use \Firebase\JWT\JWT;
class LoginUserAction extends UserAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $contents = $this->getFormData();
        $id_user = $contents["id_user"];
        $user = $this->userRepository->findUserOfId($id_user);
        if(isset($user) && $this->password_verify($contents["password"],$contents["id_user"])){
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 60; // expire time in seconds
            $token = array(
                "iss" => "THE_ISSUER",
                "aud" => "THE_AUDIENCE",
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id_user,
                ));


            $jwt = JWT::encode($token, "slkdfjslakdfklsdfjlsñdafjsñldkf");
            $res = array(
                "message"=>"Succesfully Login ",
                "jwt"=>$jwt,
                "expireAt"=>$expire_claim
            );
            return $this->respondWithData($res);
        }else{
            return $this->respondWithError(404,"sale mono sapo");
        }
    }
    private  function password_verify($password,$id){
        $real = $this->userRepository->getPassword($id);
        return $real==hash("sha256",$password);
    }
}