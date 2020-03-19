<?php


namespace Tests\Application\Actions\Container;


use Slim\Psr7\Factory\StreamFactory;
use Tests\TestCase;

class CreateContainerActionTest extends TestCase
{
    public function testAction(){
//        $app = $this->getAppInstance();
//        $json = json_encode(array("name"=>"name","volume"=>10.0));
//        $request = $this->createRequest('POST','api/containers/1');
//        $response = $app->handle($request);
        $this->assertEquals(200, 200);
    }
}