<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id_cont = $this->getUrlParam("id");
        $params = $this->getFormData();
        $this->containerRepository->updateContainer($id_cont,$params);
        return $this->respondWithData();
    }
}