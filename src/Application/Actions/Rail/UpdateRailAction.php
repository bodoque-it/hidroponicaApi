<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateRailAction extends RailAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam("id");
        $id_rail = $this->getUrlParam("id_rail");
        $params = $this->getFormData();
        $this->railRepository->updateRail($id_user,$id_rail,$params);
        return $this->respondWithData();
    }
}