<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthorApiControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests auhtors endpoint for index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/authors');

        $response->assertOk();
    }

    /**
     * Tests auhtors endpoint for show method.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/api/authors/1');

        $response->assertOk();
    }

    /**
     * Tests auhtors endpoint for store method.
     *
     * @return void
     */
    public function testStore()
    {
        $now = new DateTime();
        $newAuthor = [
            'name' => 'jane',
            'surname' => 'doe',
            'country' => 'España',
            'language' => 'Español',
            'birth_date' => $now->format('Y-m-d'),
        ];

        $response = $this->post('/api/authors', $newAuthor);

        $response->assertCreated();
    }

    /**
     * Tests auhtors endpoint for update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $author = [
            'name' => 'newAuthorName',
        ];

        $response = $this->put('/api/authors/1', $author);

        $response->assertOk()->assertSee('newAuthorName');
    }

    /**
     * Tests auhtors endpoint for delete method.
     *
     * @return void
     */
    public function testDelete()
    {
        $response = $this->delete('/api/authors/1');

        $response->assertOk();
    }
}
