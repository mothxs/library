<?php

namespace Tests\Feature;

use DateTime;
use DateInterval;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RentApiControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests rents endpoint for index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/rents');

        $response->assertOk();
    }

    /**
     * Tests rents endpoint for store method.
     *
     * @return void
     */
    public function testStore()
    {
        $now = new DateTime();
        $newRent = [
            'book_id' => '1',
            'partner_id' => '1',
            'start_date' => $now->format('Y-m-d'),
            'end_date' => $now->add(new DateInterval('P5D'))->format('Y-m-d'),
            'qty' => '1'
        ];

        $response = $this->post('/api/rents', $newRent);

        $response->assertCreated();
    }

    /**
     * Tests rents endpoint for show method.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/api/rents/1');

        $response->assertOk();
    }

    /**
     * Tests rents endpoint for update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $now = new DateTime();
        $rent = [
            'end_date' => $now->add(new DateInterval('P7D'))->format('Y-m-d'),
            'times_extended' => '2',
        ];

        $response = $this->put('/api/rents/1', $rent);

        $response->assertOk();
    }

    /**
     * Tests rents endpoint for delete method.
     *
     * @return void
     */
    public function testDelete()
    {
        $response = $this->delete('/api/rents/1');

        $response->assertOk();
    }
}
