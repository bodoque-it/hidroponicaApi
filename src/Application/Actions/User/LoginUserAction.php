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
        $username = $contents["username"];
        $this->logger->info("se buscara el usuario con username ". $username);
        $user = $this->userRepository->findUserOfUsername($username);
        if($this->password_verify($contents["password"],$user->getHashPassword())){
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + (60*15); // expire time in seconds
            $token = array(
                "iss" => "THE_ISSUER",
                "aud" => "THE_AUDIENCE",
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $user->getHashPassword(),
                ));


            $jwt = JWT::encode($token, getenv("SECRET_KEY"));
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
    private  function password_verify($password,$hash_password){
        return $hash_password==hash("sha256",$password);
    }
}