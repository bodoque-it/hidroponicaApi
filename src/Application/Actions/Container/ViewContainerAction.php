<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ViewContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id_cont = $this->getUrlParam("id_cont");
        $id = $this->getUrlParam("id");
        $cont = $this->containerRepository->findById($id,$id_cont);
        return $this->respondWithData($cont);

    }
}