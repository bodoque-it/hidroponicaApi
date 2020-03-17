<?php


namespace Tests\Application\Actions\User;


use App\Application\Actions\ActionPayload;
use App\Domain\User\User;
use Tests\TestCase;

class ListUserActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/api/users');
        $response = $app->handle($request);
        $this->assertEquals($response->getStatusCode(), 200);
    }
}