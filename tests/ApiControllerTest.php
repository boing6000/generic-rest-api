<?php

use \Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testInvalidModel()
    {
        $response = $this->call('GET', '/api/v1/dupa');
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testIndex()
    {
        $users = factory(App\User::class, 2)->create();

        $this->json('GET', '/api/v1/user')
            ->seeJson($users[0]->toArray())
            ->seeJson($users[1]->toArray());
    }

    public function testShow()
    {
        $user = factory(App\User::class)->create();

        $this->json('GET', '/api/v1/user/1')
            ->seeJson($user->toArray());
    }

    public function testShowWithInvalidId()
    {
        $this->json('GET', '/api/v1/user/100000')
            ->seeJson(['success' => false]);
    }

    public function testCreate()
    {
        $name = str_random();
        $email = str_random().'@email.com';
        $password = bcrypt(str_random());

        $this->json('POST', '/api/v1/user', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ])->seeJson(['success' => true]);
    }

    public function testUpdate()
    {
        factory(App\User::class)->create();

        $name = str_random();

        $this->json('PUT', '/api/v1/user/1', ['name' => $name])
            ->seeJson(['success' => true])
            ->seeInDatabase('users', ['name' => $name]);
    }

    public function testUpdateWithInvalidId()
    {
        $this->json('PUT', '/api/v1/user/100000')
            ->seeJson(['success' => false]);
    }

    public function testDelete()
    {
        $user = factory(App\User::class)->create();

        $this->json('DELETE', '/api/v1/user/1')
            ->seeJson(['success' => true])
            ->notSeeInDatabase('users', ['id' => $user->id]);
    }

    public function testDeleteWithInvalidId()
    {
        $this->json('DELETE', '/api/v1/user/100000')
            ->seeJson(['success' => false]);
    }
}
