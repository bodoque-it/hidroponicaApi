<?php


namespace Tests\Application;


use Tests\TestCase;

class HelloRouteTest extends TestCase
{

    public function testBaseURL(){
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/');
        $response = $app->handle($request);
        $this->assertEquals($response->getStatusCode(), 200);
    }
}