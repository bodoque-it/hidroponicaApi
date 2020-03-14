<?php


namespace App\Application\Actions\Cycle;


use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ViewCycleAction extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->getUrlParam('id_cycle');
        $id_user = $this->getUrlParam('id_user');
        $cycle = $this->cycleRepository->findById($id_cycle);
        if($id_user != $cycle->getOwner()->getId()){
            throw new HttpBadRequestException($this->request);
        }
        return $this->respondWithData($cycle);
    }
}