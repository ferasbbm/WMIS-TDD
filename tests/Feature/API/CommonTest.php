<?php

namespace Tests\Feature\API;

use Tests\TestCase;

/**
 * Class CommonTest
 *
 * @author  <feras.bbm@gmail.com>
 * @package Tests\Feature\API
 */
class CommonTest extends TestCase
{
    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function apiIsAccessible()
    {
        $this->json('get', 'api/v1/test-is-accessible')
            ->assertStatus(200);
    }

    /**
     * @return void
     * @author <ferasbbm>
     */
    public function driverCanListVehicleCheckList()
    {
        $this->json('get', 'api/v1/vehicle/vehicle-check-list')
            ->assertStatus(200);
    }

}
