<?php


namespace Tests\Domain\Container;


use Tests\TestCase;
use App\Domain\Container\Container;

class ContainerTest extends TestCase
{
    public function testCreateContainerIsActivate(){
        $cont = new Container(1,12.5,"run");
        self::assertEquals(false,$cont->isActivate());
    }

    public function testContainerIsActivate(){
        $cont = new Container(2,123,"dos",true);
        self::assertEquals(true,$cont->isActivate());
    }
}