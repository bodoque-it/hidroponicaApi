<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteUserAction extends UserAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $params = $this->getFormData();
        $res= array();
        if(isset($params["id_user"])){
            $res["status"] = $this->userRepository->deleteUser($params["id_user"]);

        }
        return $this->respondWithData($res);
    }
}