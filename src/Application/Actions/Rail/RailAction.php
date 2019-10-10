<?php


namespace App\Application\Actions\Rail;


use App\Application\Actions\Action;
use App\Domain\Rail\RailRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

abstract class RailAction extends Action
{
    protected $railRepository;
    public function __construct(LoggerInterface $logger, RailRepository $railRepository)
    {
        parent::__construct($logger);
        $this->railRepository = $railRepository;
    }
}