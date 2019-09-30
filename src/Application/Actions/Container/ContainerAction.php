<?php


namespace App\Application\Actions\Container;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;

abstract  class ContainerAction extends Action
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param LoggerInterface $logger
     * @param UserRepository  $userRepository
     */
    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }
}