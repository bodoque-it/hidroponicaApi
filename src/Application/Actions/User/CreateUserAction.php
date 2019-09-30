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
        $newUser = $this->userRepository->createUser($contents["username"],$contents["first_name"],$contents["last_name"],$password,$contents["email"]);
        //$this->logger->info("User Created");
        return $this->respondWithData($newUser);
    }
}