<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class MakeRailAction extends RailAction
{
    protected function action(): Response
    {
        $params = $this->railRepository->getColumns();
        return $this->respondWithData($params);
    }
}