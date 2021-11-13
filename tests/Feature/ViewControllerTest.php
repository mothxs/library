<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ViewControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests if books view is returned in response
     *
     * @return void
     */
    public function testBooksView()
    {
        $response = $this->get('/library/books');

        $response->assertViewIs('library::books');
    }

    /**
     * Tests if books view is returned in response
     *
     * @return void
     */
    public function testAuthorsView()
    {
        $response = $this->get('/library/authors');

        $response->assertViewIs('library::authors');
    }

    /**
     * Tests if editorials view is returned in response
     *
     * @return void
     */
    public function testEditorialsView()
    {
        $response = $this->get('/library/editorials');

        $response->assertViewIs('library::editorials');
    }

    /**
     * Tests if partners view is returned in response
     *
     * @return void
     */
    public function testPartnersView()
    {
        $response = $this->get('/library/partners');

        $response->assertViewIs('library::partners');
    }

    /**
     * Tests if rents view is returned in response
     *
     * @return void
     */
    public function testRentsView()
    {
        $response = $this->get('/library/rents');

        $response->assertViewIs('library::rents');
    }

    /**
     * Tests that the controller abors with 404 not found
     *
     * @return void
     */
    public function testInventedView()
    {
        $response = $this->get('/library/randominventedview');

        $response->assertStatus(404);
    }
}
