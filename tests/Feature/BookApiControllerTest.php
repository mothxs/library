<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BookApiControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests books endpoint for index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/books');

        $response->assertOk();
    }

    /**
     * Tests books endpoint for show method.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/api/books/1');

        $response->assertOk();
    }

    /**
     * Tests books endpoint for store method.
     *
     * @return void
     */
    public function testStore()
    {
        $newBook = [
            'title' => 'libro1',
            'isbn' => '1234567891234',
            'pages' => '223',
            'author_id' => '1',
            'editorial_id' => '1',
            'qty' => '100',
        ];

        $response = $this->post('/api/books', $newBook);

        $response->assertCreated();
    }

    /**
     * Tests books endpoint for update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $book = [
            'title' => 'libro2',
            'isbn' => '1234567891234',
            'pages' => '223',
            'author_id' => '1',
            'editorial_id' => '1',
            'qty' => '100',
        ];

        $response = $this->put('/api/books/1', $book);

        $response->assertOk()->assertSee('libro2');
    }

    /**
     * Tests books endpoint for delete method.
     *
     * @return void
     */
    public function testDelete()
    {
        $response = $this->delete('/api/books/1');

        $response->assertOk();
    }
}
