<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateRailAction extends RailAction
{

    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $params = $this->getFormData();
        $this->railRepository->createRail($id, $params);
        return $this->respondWithData();
    }
}