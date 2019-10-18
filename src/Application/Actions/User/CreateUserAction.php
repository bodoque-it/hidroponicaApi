<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateUserAction extends  UserAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $contents = $this->getFormData();
        $password = hash("sha256",$contents["password"]);
        $id_user = $this->userRepository->createUser($contents["username"],$contents["first_name"],$contents["last_name"],$password,$contents["email"]);
        if($id_user>0){
            $this->logger->info("User Created with id_user : ".$id_user);
            return $this->respondWithData($id_user);
        }else{
            return $this->respondWithError(400,"El usuario no ha podido ser creado");
        }
    }
}