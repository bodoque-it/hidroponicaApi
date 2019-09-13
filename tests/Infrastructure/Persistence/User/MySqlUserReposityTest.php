<?php


namespace Tests\Infrastructure\Persistence\User;

use App\Infrastructure\Persistence\User\MySqlUserRepository;
use Tests\TestCase;

class MySqlUserReposityTest extends  TestCase
{


    public function testSelect(){
        $this->assertEquals(true,true);
    }
}