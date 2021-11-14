<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EditorialApiControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests editorials endpoint for index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/editorials');

        $response->assertOk();
    }

    /**
     * Tests editorials endpoint for show method.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/api/editorials/1');

        $response->assertOk();
    }

    /**
     * Tests editorials endpoint for store method.
     *
     * @return void
     */
    public function testStore()
    {
        $now = new DateTime();
        $newEditorial = [
            'name' => 'Editorial1',
            'country' => 'España',
            'foundation_date' => $now->format('Y-m-d'),
            'website' => '',
        ];

        $response = $this->post('/api/editorials', $newEditorial);

        $response->assertCreated();
    }

    /**
     * Tests editorials endpoint for update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $now = new DateTime();
        $editorial = [
            'name' => 'Editorial2',
            'country' => 'España',
            'foundation_date' => $now->format('Y-m-d'),
            'website' => '',
        ];

        $response = $this->put('/api/editorials/1', $editorial);

        $response->assertOk()->assertSee('Editorial2');
    }

    /**
     * Tests editorials endpoint for delete method.
     *
     * @return void
     */
    public function testDelete()
    {
        $response = $this->delete('/api/editorials/1');

        $response->assertOk();
    }
}
