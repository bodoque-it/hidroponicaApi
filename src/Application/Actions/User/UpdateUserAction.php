<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateUserAction extends UserAction
{

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $contents = $this->getFormData();
        $passwordIsChange=false;
        if(isset($contents["pass_word"])){
            $passwordIsChange = true;
            $password = hash('sha256',$contents["pass_word"]);
            $contents["pass_word"] = $password;
        }
        $isSuccessfully = $this->userRepository->updateUser($contents["id_user"],$contents);
        $res = array();
        if($isSuccessfully && $passwordIsChange){
            $res["password"] = true;
        }else if($isSuccessfully){
            $res["status"] = true;
        }

        return $this->respondWithData($res);
    }
}