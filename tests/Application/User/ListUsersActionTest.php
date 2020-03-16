<?php


namespace Tests\Application\User;


use App\Application\Actions\ActionPayload;
use App\Domain\User\User;
use Tests\TestCase;

class ListUsersActionTest extends TestCase
{
    public function test_all_user_request(){
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/api/users');
        $response = $app->handle($request);
        //fwrite(STDERR, print_r((string)$response->getBody(), TRUE));
        $this->assertEquals($response->getStatusCode(), 200);
    }
}