<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteRailAction extends RailAction
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
        $res = $this->railRepository->deleteRail($id_user,$id_rail);
        if($res<1){
            return $this->respondWithError(400,"no elimine niuna wea");
        }
        return $this->respondWithData();
    }
}