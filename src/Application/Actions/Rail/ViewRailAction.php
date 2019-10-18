<?php

namespace App\Application\Actions\Rail;
use App\Application\Actions\Rail\RailAction;

class ViewRailAction extends RailAction
{

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \App\Domain\DomainException\DomainRecordNotFoundException
     * @throws \Slim\Exception\HttpBadRequestException
     */
    protected function action(): \Psr\Http\Message\ResponseInterface
    {
        $id_user = $this->getUrlParam("id");
        $id_rail = $this->getUrlParam("id_rail");
        $rail = $this->railRepository->getRailById($id_user,$id_rail);
        return $this->respondWithData($rail);
    }
}