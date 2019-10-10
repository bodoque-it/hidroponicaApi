<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class ListRailAction extends RailAction
{

    protected function action(): Response
    {
        /*$jwt = $this->auth();
        if(isset($jwt)){

        }*/
        $id = $this->getUrlParam('id');
        $allIdRail = $this->railRepository->getAllRails($id);
        if(count($allIdRail,COUNT_NORMAL)<1){
            throw new HttpNotFoundException($this->request);
        }
        $res = array();
        foreach ($allIdRail as $rail){
            $containers = $this->railRepository->getAllContainer($rail);
            array_push($res,$containers);
        }
        return $this->respondWithData($res);
    }
}