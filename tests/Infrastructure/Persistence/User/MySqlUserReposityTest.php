<?php


namespace Tests\Infrastructure\Persistence\User;

use App\Infrastructure\Persistence\User\MySqlUserRepository;
use Tests\TestCase;

class MySqlUserReposityTest extends  TestCase
{
    protected function setUp()
    {
    }

    public function testSelect(){
        $mysql = new MySqlUserRepository();
        $this->assertEquals($mysql->findAll()["hola"],true);
    }
}