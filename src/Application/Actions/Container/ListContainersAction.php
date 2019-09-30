<?php


namespace App\Application\Actions\Container;
use App\Application\Actions\Container\ContainerAction;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ListContainersAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        return $this->respondWithData("hola desde los contenedores");
    }
}