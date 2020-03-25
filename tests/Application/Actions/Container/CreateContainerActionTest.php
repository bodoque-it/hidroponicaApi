<?php


namespace Tests\Application\Actions\Container;


use Slim\Psr7\Factory\StreamFactory;
use Tests\TestCase;

class CreateContainerActionTest extends TestCase
{
    public function testAction(){
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST','api/containers/1/1');
        $body = [
            "name"=>"param1value",
            "volume"=> 18.8,
            "id_rail"=> 1
        ];
        $request = $request->withParsedBody($body);
        $response = $app->handle($request);
        $this->assertEquals(200, 200);
    }
}