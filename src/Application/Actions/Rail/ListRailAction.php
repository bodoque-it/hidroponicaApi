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
        $allRails = $this->railRepository->getAllRails($id);
        if(count($allRails,COUNT_NORMAL)<1){
            throw new HttpNotFoundException($this->request);
        }
        $res = array();
        foreach ($allRails as $rail){
            $containers = $this->railRepository->getAllContainer($rail->getId());
            $rail->setContainers($containers);
        }
        return $this->respondWithData($allRails);
    }
}