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
        $id_user = $this->resolveArg("id");
        $id_rail = $this->resolveArg("id_rail");
        $rail = $this->railRepository->getRailById($id_user,$id_rail);
        return $this->respondWithData($rail);
    }
}