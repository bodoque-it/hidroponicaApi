<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class MakeContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $params = $this->containerRepository->getParams();
        return $this->respondWithData($params);
    }
}