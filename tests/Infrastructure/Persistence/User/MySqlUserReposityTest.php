<?php


namespace Tests\Infrastructure\Persistence\User;

use App\Infrastructure\Persistence\User\MySqlUserRepository;
use PDO;
use Psr\Container\ContainerInterface;
use Tests\TestCase;

class MySqlUserReposityTest extends  TestCase
{

    public function testSelect(){
        self::assertEquals(true,true);
    }
}