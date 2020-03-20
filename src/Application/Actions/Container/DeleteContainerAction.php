<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id = $this->resolveArg("id");
        $res = $this->containerRepository->deleteContainer($id);
        return $this->respondWithData($res);
    }
}