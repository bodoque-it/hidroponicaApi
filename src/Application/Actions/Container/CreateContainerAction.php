<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id = $this->getUrlParam("id");
        $params = $this->getFormData();
        $row = $this->containerRepository->createContainer($id,$params);
        return $this->respondWithData($row);
    }
}